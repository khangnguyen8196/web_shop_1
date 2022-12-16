
<?php include("include/header.php");?>
<?php 
	 	 $login_check = Session::get('customer_login');
		 if($login_check==false){
			header("location:login.php");
		 }
	  ?>

<?php 
	//  if(!isset($_GET['proid']) || $_GET['proid']==NULL){
	// 	echo "<script>window.location='404.php'</script>";
	//  }else {
	// 	 $id=$_GET['proid'];
	//  }
?>
<?php
	$id=Session::get('customer_id');
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])){
		$update_profile=$cus->update_profile($_POST, $id);
    }
?>
<div class="main">
    <div class="content">
		<div class="content_top">
    		<div class="heading">
    		<h3>Update Profile Customer</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<div class="section group">
			<form action="" method="POST">
				<table class="tblone">
					<tr>
						<td colspan="3">
							<?php
								if(isset($update_profile)){
									echo $update_profile;
								}
							?>
						</td>
					</tr>
				<?php
					$id=Session::get('customer_id');
					$get_customer=$cus->show_customer($id);
					if($get_customer){
						while($result=$get_customer->fetch_assoc()){
					?>		
				
					<tr>
						<td>Name</td>
						<td>:</td>
						<td><input type="text" name="username" value="<?php echo $result['username'] ?>"/></td>
					</tr>
					<tr>
						<td>Email</td>
						<td>:</td>
						<td><input type="text" name="email" value="<?php echo $result['email'] ?>"/></td>
					</tr>
					<tr>
						<td>Country</td>
						<td>:</td>
						<td><input type="text" name="country" value="<?php echo $result['country'] ?>"/></td>
					</tr>
					<tr>
						<td>Phone Number</td>
						<td>:</td>
						<td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"/></td>
					</tr>
					<tr>
						<td>Zip Code</td>
						<td>:</td>
						<td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"/></td>
					</tr>
					<tr>
						<td>Địa chỉ</td>
						<td>:</td>
						<td><input type="text" name="address" value="<?php echo $result['address'] ?>"/></td>
					</tr>
					<tr>
						<td>City</td>
						<td>:</td>
						<td><input type="text" name="city" value="<?php echo $result['city'] ?>"/></td>
					</tr>
					<tr>
						<td colspan="3"><input type="submit" name="save" value="Save" /></td>
					</tr>
				<?php }
					}
				?>
				</table>
			</form>
		</div>
 	</div>
</div>
<?php include("include/footer.php");?>
