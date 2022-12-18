
<?php include("include/header.php");?>

<?php
	 if(isset($_GET['proid'])){
		$customerId=Session::get('customer_id');
		$productId=$_GET['proid'];
		$del_wish=$product->del_wish($productId,$customerId);
	 }
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Wish List</h2>
						<table class="tblone">
							<tr>
								<th width="10%">STT</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>
							</tr>
							<?php
								$customerId=Session::get('customer_id');
								$get_wish_list=$product->get_wish_list($customerId);
								if($get_wish_list){
									$i=0;
									while($result=$get_wish_list->fetch_assoc()){
									$i++;
								?>	
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $result['productname'] ?></td>
									<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
									<td><?php echo $result['price'] ?></td>
									<td>
										<a href="?proid=<?php echo $result['productId'] ?>">Remove</a> ||
										<a href="detail.php?proid=<?php echo $result['productId'] ?>">Buy Now</a>
									</td>
								</tr>
							<?php 
							 }}
							?>
						</table>
					  
			</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<?php 
								$login_check = Session::get('customer_login');
								if($login_check==false){
									echo '<a href="login.php"><img src="images/check.png" alt="" /></a>';
								}else {
									echo '<a href="payment.php"> <img src="images/check.png" alt="" /></a>';
								}
							?>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include("include/footer.php");?>
