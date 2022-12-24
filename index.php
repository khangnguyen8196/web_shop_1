<?php 
	include("include/header.php");
	include("include/slider.php");	
?>
<?php 
	$tukhoa='';
	if(isset($_GET['tukhoa'])){
		$tukhoa=$_GET['tukhoa'];
	}
	// total
	if(!isset($_GET['page']) ){
		$current_page=1;
	}elseif($_GET['page']==0){
		$current_page=1;
	}else{
		$current_page=$_GET['page'];
	}
	$item_page=4;
	$start = ($current_page - 1)*$item_page;
	$count = $product->search_product($start,$item_page,['tukhoa'=>$tukhoa, 'count'=>true]);
	$total_page=ceil($count/$item_page);
	// data
	$product_all = $product->search_product($start,$item_page,['tukhoa'=>$tukhoa ]);
?>
<style>
	.grid_1_of_5{
	display: block;
	float:left;
	margin: 1% 0 1% 1.6%;
	box-shadow: 0px 0px 3px rgb(150, 150, 150);
}
	.grid_1_of_5:nth-child(4n+1) { 
	margin-left: 0; 
} 
	.images_1_of_5 {
	width: 20.8%;
	padding:1.5%;
	text-align:center;
	position:relative; 
}
	.images_1_of_5  img{
	max-width:100%;
}
	.pagination{
		text-align: center;
		padding-bottom: 20px;
	}

</style>

 <div class="main">
    <div class="content">
		<div class="content_top">
    		<div class="heading">
    			<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
			<div class="section group">
				<?php
					$product_new = $product->getproduct_new();
					if($product_new){
						foreach($product_new as $key => $result_new){ ?>
							<div class="grid_1_of_5 images_1_of_5">
								<a href="detail.php?proid=<?php echo $result_new['productId']; ?>"><img with="140px" height="140px" src="admin/uploads/<?php echo $result_new['image']; ?>" alt="image" /></a>
								<h2><?php echo $result_new['productname']; ?> </h2>
								<p><?php echo $fm->textShorten($result_new['description'], 50);?></p>
								<p><span class="price"><?php echo $result_new['price']." "."VNĐ" ?></span></p>
								<div class="button"><span><a href="detail.php?proid=<?php echo $result_new['productId']; ?>" class="details">Details</a></span></div>
							</div>
						<?php }
					}
					?>
			</div>
    	</div>
    	<div class="content_bottom">
    		<div class="heading">
    			<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
			<div class="section group">
				<?php
					$product_all = $product->search_product($start,$item_page,['tukhoa'=>$tukhoa ]);
					if($product_all){
						foreach($product_all as $key => $result){ ?>
							<div class="grid_1_of_5 images_1_of_5">
								<a href="detail.php?proid=<?php echo $result['productId']; ?>"><img with="140px" height="140px" src="admin/uploads/<?php echo $result['image']; ?>" alt="image" /></a>
								<h2><?php echo $result['productname']; ?> </h2>
								<p><?php echo $fm->textShorten($result['description'], 50);?></p>
								<p><span class="price"><?php echo $result['price']." "."VNĐ" ?></span></p>
								<div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
							</div>
						<?php }
					}
					?>	
			</div>
    	</div>
	    	
    </div>
	<!-- <h5>Phân trang:</h5> -->
		<div class="pagination">
			<?php
					echo "<h4>Trang</h4>";
					if ($current_page > 1 && $total_page > 1){
						echo '<a href="index.php?page='.($current_page-1).''.(($tukhoa!='')?"&tukhoa=$tukhoa":'').'">Prev</a> | ';
					}
					for($i=1;$i<=$total_page;$i++){
						if($i !=$current_page){?> 

							<?php echo '<a class="product_button" style="margin:0 5px" href="index.php?page='.$i.''.(($tukhoa!='')?"&tukhoa=$tukhoa":'').'">'.$i.'</a>'; ?>
					<?php } 
							else {?>
						<?php echo '<strong >'.$i.'</strong>' ?>

					<?php } ?>
						
				<?php }
					if ($current_page < $total_page && $total_page > 1){
						echo '|<a href="index.php?page='.($current_page+1).''.(($tukhoa!='')?"&tukhoa=$tukhoa":'').'">Next</a> ';
					}
				?>
		</div>
 </div>

 <?php include("include/footer.php");?>

