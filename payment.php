
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
	// if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    //    $quantity=$_POST['quantity'];
	// 	$addCart=$cart->add_to_cart($quantity,$id);
    // }
?>
<style>
	.wrapper_method {
		width: 550px;
		margin: 18px auto;
		border: 1px solid #ccc;
		padding: 20px;
		text-align: center;
		background-color: orange;
	}
	.previous{
		margin-top:10px;
	}
	.previous a {
		padding: 5px;
		background-color: #666;
		border-radius: 3px;
	}
	h3 {
		font-size: 24px;	
		font-weight: 600;
		color:red;
	}
	.payment {
		margin-top:18px;
		display: flex;
		justify-content: space-around;
	}
	.payment a {
		border:none;
		border-radius: 3px;
		/* border: 1px solid #ccc; */
		padding: 10px 15px;
		background-color: green;
		cursor: pointer;
	}
	
</style>
<div class="main">
    <div class="content">
		<div class="content_top">
    		<div class="heading">
    		<h3>Payment Method</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<div class="wrapper_method">
			<h3>Choose your method payment</h3>
			<div class="payment">
				<a href="offlinepayment.php">Offline Payment</a>
				<a href="onlinepayment.php">Online Payment</a>	
			</div>
			<div class="previous">
				<a href="cart.php">previous</a>	
			</div>
		</div>
 	</div>
</div>
<?php include("include/footer.php");?>
