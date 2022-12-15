
<?php include("include/header.php");?>

<?php 
	 if(!isset($_GET['proid']) || $_GET['proid']==NULL){
		echo "<script>window.location='404.php'</script>";
	 }else {
		 $id=$_GET['proid'];
	 }
?>
<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
       $quantity=$_POST['quantity'];
		$addCart=$cart->add_to_cart($quantity,$id);
    }
?>
<div class="main">
    <div class="content">
    	<div class="section group">
				<?php 
					$get_detail=$product->getDetail($id);
					if($get_detail){
						while($result=$get_detail->fetch_assoc()){
					?>		
				
					<div class="cont-desc span_1_of_2">				
						<div class="grid images_3_of_2">
							<img src="/admin/uploads/<?php echo $result['image'];?>" alt="image" />
						</div>
						<div class="desc span_3_of_2">
							<h2><?php echo $result['productname'];?></h2>
							<p><?php echo $fm->textShorten($result['description'],100) ;?></p>					
							<div class="price">
								<p>Price: <span><?php echo $result['price']." "."VNĐ";?></span></p>
								<p>Category: <span><?php echo $result['catname'];?></span></p>
								<p>Brand:<span><?php echo $result['brandname'];?></span></p>
							</div>
							<div class="add-cart">
								<form action="" method="post">
									<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
									<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>	
								</form>
								<?php
										if(isset($addCart)){
											echo '<span class="error">Product already added</span>';
										}
								?>				
							</div>
						</div>
						<div class="product-desc">
							<h2><?php echo $result['productname'];?></h2>
							<p><?php echo $result['description'];?></p>					
							<p></p>
							
						</div>
					
					</div>
				<?php
				}}
				?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<?php
					$getAllCategory=$cat->show_category_frontend();
					if($getAllCategory){
						while($result_cat=$getAllCategory->fetch_assoc()){
					?> 
					<ul>
				      <li><a href="productbycat.php?categoryId=<?php echo $result_cat['categoryId'] ?>"><?php echo $result_cat['catname'] ?></a></li>
    				</ul>
					<?php
					}}
					?>
 				</div>
		</div>
 	</div>
</div>
<?php include("include/footer.php");?>
