<?php 
	 if(!isset($_GET['brandId']) || $_GET['brandId']==NULL){
		echo "<script>window.location='404.php'</script>";
	 }else {
		 $id=$_GET['brandId'];
	 }
?>


<?php include("include/header.php");?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
		<?php 
				$name_brand =$brand->getbrandbyId($id);
				if($name_brand){
					foreach($name_brand as $key=>$result_name){
		?>
    		<div class="heading">
    		<h3><?php echo $result_name['brandname'] ?></h3>
    		</div>
		<?php	
			}
			}else {
				echo "<span class='error'>Category not have product!</span>";
			}
		?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php 
				$productbybrand =$brand->get_brand_by_id($id);
				if($productbybrand){
					foreach($productbybrand as $key=>$result){
				?>
				<div class="grid_1_of_5 images_1_of_5">
					 <a href="detail.php?proid=<?php echo $result['productId']; ?>"><img width="140px" height="140px" src="admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					 <h2><?php echo $result['productname'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productname'], 50)?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price']." "."VNĐ") ?></span></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php	
				}
				}
				?>
			</div>

	
	
    </div>
 </div>
 <?php include("include/footer.php");?>
