<?php
    include_once("lib/session.php");
    Session::init();
?>
<?php 
	 include_once("lib/database.php");
	 include_once("helpers/format.php");
	 spl_autoload_register(function($className) {
		include_once "classes/".$className.".php";
	});

	$db = new Database();
	$fm = new Format();
	$cart= new cart();
	$cus= new customer();
	$cat = new category();
	$brand = new brand();
	$product= new product();
?>
 
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<?php
	$tukhoa='';
	if(isset($_GET['tukhoa'])){
		$tukhoa= $_GET['tukhoa'];
	}
?>

<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu_1.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/slider.css" rel="stylesheet" type="text/css" media="all"/>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
</head>
<body>
<div class="wrap">
	<div class="header_top">
			<div class="logo">
				<a href="index.php"><img width="230px" height="100px" src="images/logoshop.png" alt="" /></a>
			</div>
			  	<div class="header_top_right">
					<div class="search_box" enctype="multipart/form-data">
						<form action="" method="GET" >
							<input type="text" id="tukhoa" value="<?php echo $tukhoa?>" name="tukhoa" placeholder="Search for Products">
							<input type="submit" id ="search" name="search" value="SEARCH">
						</form>
					</div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="cart.php" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart:</span>
								<span class="cart_notice">
									<?php
										$check_cart=$cart->check_cart();
										if($check_cart){
											$qty=Session::get("qty");
											echo $qty;
										}else {
											echo "0";
										}
									?>
								</span>
								<span class="no_product">
									<?php
										$check_cart=$cart->check_cart();
										if($check_cart){
											$sum=Session::get("sum");
											echo $sum." "."VNĐ";
										}else {
											echo "Empty";
										}
										
									?>
								</span>
						</a>
					</div>
			    </div>
				  <?php
				 	if(isset($_GET['customer_id'])){
						$delCart =$cart->del_all_cart();
						Session::destroy();
					} 
				  ?>
		   	<div class="login">
				<?php
				$login_check = Session::get('customer_login');
				if($login_check==false){
					echo '<a href="login.php">Login</a>';
				}else {
					echo '<a href="?customer_id='.Session::get('customer_id').'">Logout</a>';
				}
				?>
			</div>
		 <div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
<div class="menu">
	<ul id="" class="parent_menu">
	  	<li><a href="index.php">Home</a></li>
	  	<li>
			<a href="products.php">Category</a> 
			<ul class="submenu">
				<div class="menu_list">
				<?php
					$getAllCategory=$cat->show_category_frontend();
						if($getAllCategory){
							foreach($getAllCategory as $key=>$result_cat){
				?> 
							<ul>
								<li><a href="productbycat.php?categoryId=<?php echo $result_cat['categoryId'] ?>"><?php echo $result_cat['catname'] ?></a></li>
							</ul>
						<?php
							}
						}
							?>
				</div>
			</ul>
		</li>
	  	<li>
			<a href="topbrands.php">Top Brands</a>
			<ul class="submenu">
				<div class="menu_list">
				<?php
					$get_all_brand=$brand->show_brand();
						if($get_all_brand){
							foreach($get_all_brand as $key=>$result){
				?> 
							<ul>
								<li><a href="productbybrand.php?brandId=<?php echo $result['brandId'] ?>"><?php echo $result['brandname'] ?></a></li>
							</ul>
						<?php
							}
						}
							?>
				</div>
			</ul>
		</li>
						
		<?php 
			$check_cart = $cart->check_cart();
			if($check_cart==false){
				echo '';
			}else {
				echo '<li><a href="cart.php">Cart</a></li>';
			}
		?>
	  	<?php 
	  	$customerId=Session::get('customer_id');
	 	$check_order = $cart->check_order($customerId);
		if($check_order==false){
			echo '';
		}else {
			echo '<li><a href="orderdetail.php">Ordered</a></li>';
		}
	  	?>
	  	<li><a href="contact.php">Contact</a> </li>
	  	<?php 
	 	 $login_check = Session::get('customer_login');
		 if($login_check==false){
			echo '<li><a href="register.php">Register</a> </li>';
		 }else {
			echo '<li><a href="profile.php">Profile</a> </li>';
		 }
	  	?>
	  	<?php 
	 	 $login_check = Session::get('customer_login');
		 if($login_check==false){
			echo '';
		 }else {
			echo '<li><a href="wishlist.php">WishList</a> </li>';
		 }
	  	?>
	  <div class="clear"></div>
	</ul>
</div>

