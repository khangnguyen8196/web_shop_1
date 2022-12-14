
<?php include("include/header.php");?>
<?php include("include/slider.php");?>

<?php 
	 if(!isset($_GET['proid']) || $_GET['proid']==NULL){
		echo "<script>window.location='404.php'</script>";
	 }else {
		 $id=$_GET['proid'];
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
								<form action="cart.php" method="post">
									<input type="number" class="buyfield" name="" value="1"/>
									<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
								</form>				
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
					<ul>
				      <li><a href="productbycat.php">Mobile Phones</a></li>
    				</ul>
 				</div>
		</div>
 	</div>
</div>
<?php include("include/footer.php");?>