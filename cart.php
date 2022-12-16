
<?php include("include/header.php");?>

<?php
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
		$cartId=$_POST['cartId'];


		$quantity=$_POST['quantity'];
		$update_quantity_cart=$cart->update_quantity_cart($quantity,$cartId);

		if($quantity<=0){
			$delcart=$cart->delete_product_cart($cartId);
		}
    }

	if(isset($_GET['cartId'])){
		$cartId=$_GET['cartId'];
		$delcart=$cart->delete_product_cart($cartId);

	}

	if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
					<?php
						if(isset($update_quantity_cart)){
							echo '<span class="success">Product quantity update successfully!</span>';
						}
						if(isset($delcart)){
							echo $delcart ;
						}
					?>
			    	<h2>Your Cart</h2>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
								$get_product_cart=$cart->get_product_cart();
								if($get_product_cart){
									$subtotal=0;
									$qty=0;
									while($result=$get_product_cart->fetch_assoc()){
								?>	
								<tr>
									<td><?php echo $result['productname'] ?></td>
									<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
									<td><?php echo $result['price'] ?></td>
									<td>
										<form action="" method="post">
											<input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" min="0"/>
											<input type="number" name="quantity" value="<?php echo $result['quantity'] ?>" min="0"/>
											<input type="submit" name="submit" value="Update"/>
										</form>
									</td>
									<td>
										<?php
										$total=$result['price'] * $result['quantity'];
										echo $total." "."VNĐ" ;
										?>
									</td>
									<td><a href="?cartId=<?php echo $result['cartId'] ?>">Xoá</a></td>
								</tr>
							<?php 
									$subtotal +=$total;
									$qty =$qty + $result['quantity'];
									
							 }}
							?>
						</table>
						<?php
							$check_cart=$cart->check_cart();
								if($check_cart){										
						?>
						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php 
									echo $subtotal." "."VNĐ"; 
									Session::set("sum", $subtotal);
									Session::set("qty", $qty);
									?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10%</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php
										$vat=$subtotal * 0.1;
										$grantotal =$subtotal + $vat;
										echo $grantotal." "."VNĐ";
									?>
									</td>
							</tr>
					   </table>
					   <?php 
							}else {
								echo 'Your Cart is empty ! You can shopping now';
							}
						?>
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
