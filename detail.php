
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
	$customerId=Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])){
		$productid=$_POST['productid'];
		 $insertWishlist=$product->insertWishlist($productid,$customerId);
	}
	
	if(isset($_POST['comment_submit'])){
		$comments=$cus->insert_comment();
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
								<p>Price: <span><?php echo $fm->format_currency($result['price']." "."VNĐ");?></span></p>
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
							<div class="add-cart">
								<form action="" method="post">
									<input type="hidden"  name="productid" value="<?php echo $result['productId'] ?>"/>	
								
								<?php
									$login_check = Session::get('customer_login');
										if($login_check){
											echo '<input type="submit" class="buysubmit" name="wishlist" value="Save to Wishlist"/>	';
										}else {
											echo '';
										}
								?>
								<?php 
									if(isset($insertWishlist)){
										echo $insertWishlist;
									}
								?>
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
					<?php
					$getAllCategory=$cat->show_category_frontend();
					if($getAllCategory){
						foreach($getAllCategory as $key=>$result_cat){
					?> 
					<ul>
				      <li><a href="productbycat.php?categoryId=<?php echo $result_cat['categoryId'] ?>"><?php echo $result_cat['catname'] ?></a></li>
    				</ul>
					<?php
					}}
					?>
 				</div>
		</div>
		<div class="comment">
			<div class="row">	
				<div class="col-md-8">
					<h5>Ý kiến người dùng</h5>
					<?php 
						if(isset($comments)){
							echo $comments;
						}
					?>
					<form action="" method="POST">
						<p><input type="hidden" value="<?php echo $id ?>" name="productId_comment"/></p>
						<p?><input type="text" placeholder="Chat Name" class="form-control" name="commentator"></p>
						<p><textarea rows="5" style="resize:none" placeholder="Comment..." class="form-control" name="comment"></textarea></p>
						<p><input type="submit" name="comment_submit" class="btn btn-primary" value="SEND COMMENT"/></p>
					</form>
				</div>
			</div>		
		</div>
 	</div>
</div>
<?php include("include/footer.php");?>
