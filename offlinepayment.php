
<?php include("include/header.php");?>

<?php 
	 if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
		$userId=Session::get('customer_id');
		$insertOrder=$cart->insert_order($userId);
		$delCart =$cart->del_all_cart();
		header('location:success.php');
	 }
?>

<style>
	.cart_order {
    overflow: hidden;
    padding: 10px;
	}
	.box_left {
		width: 48%;
		border:1px solid #333;
		float:left;
		padding: 10px 0;
	}
	.box_right {
		width: 48%;
		border:1px solid #333;
		float:right;
		padding: 10px 0;
	}
	a.order {
	display: inline-block;
    padding: 8px 46px;
    border: none;
    background-color: darkorange;
    border-radius: 3px;
    color: white;
    font-size: 18px;
	cursor: pointer;
	margin-top:20px;
}
</style>
<div class="main">
	<form action="" method="POST">
    <div class="content">	
    		<div class="heading">
    		<h3>Offline payment</h3>
    		</div>
    		<div class="clear"></div>
    	<div class="section group">
			
				<div class="box_left">
					<div class="cart_order">
						<?php
							if(isset($update_quantity_cart)){
								echo '<span class="success">Product quantity update successfully!</span>';
							}
							if(isset($delcart)){
								echo $delcart ;
							}
						?>
							<table class="tblone">
								<tr>
									<th width="5%">STT</th>
									<th width="20%">Product Name</th>
									<th width="10%">Image</th>
									<th width="20%">Price</th>
									<th width="20%">Quantity</th>
									<th width="25%">Total Price</th>
								</tr>
								<?php 
									$get_product_cart=$cart->get_product_cart();
									if($get_product_cart){
										$subtotal=0;
										$qty=0;
										$i=0;
										while($result=$get_product_cart->fetch_assoc()){
											$i++;
									?>	
									<tr>
										<td><?php echo $i; ?></td>
										<td><?php echo $result['productname'] ?></td>
										<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
										<td><?php echo $result['price'] ?></td>
										<td>
												<?php echo $result['quantity'] ?>
										</td>
										<td>
											<?php
											$total=$result['price'] * $result['quantity'];
											echo $total." "."VNĐ" ;
											?>
										</td>
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
							<table style="display:block;float:right;text-align:left;" width="40%" >
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
									<td>10%(<?php echo $vat=$subtotal * 0.1." "."VNĐ" ?>)</td>
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
				</div>
				<div class="box_right">
					<table class="tblone">
					<?php
						$id=Session::get('customer_id');
						$get_customer=$cus->show_customer($id);
						if($get_customer){
							while($result=$get_customer->fetch_assoc()){
						?>		
					
						<tr>
							<td>Name</td>
							<td>:</td>
							<td><?php echo $result['username'] ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td>:</td>
							<td><?php echo $result['email'] ?></td>
						</tr>
						<tr>
							<td>Country</td>
							<td>:</td>
							<td><?php echo $result['country'] ?></td>
						</tr>
						<tr>
							<td>Phone Number</td>
							<td>:</td>
							<td><?php echo $result['phone'] ?></td>
						</tr>
						<tr>
							<td>Zip Code</td>
							<td>:</td>
							<td><?php echo $result['zipcode'] ?></td>
						</tr>
						<tr>
							<td>Địa chỉ</td>
							<td>:</td>
							<td><?php echo $result['address'] ?></td>
						</tr>
						<tr>
							<td>City</td>
							<td>:</td>
							<td><?php echo $result['city'] ?></td>
						</tr>
						<tr>
							<td colspan="3"><a href="editprofile.php">Update Profile</a></td>
						</tr>
					<?php }
						}
					?>
					</table>
				</div>
			
		</div>
		<center><a href="?orderId=order" class="order">Order New</a></center>
 	</div>
	</form>
</div>
<?php include("include/footer.php");?>
