
<?php include("include/header.php");?>

<?php
				$login_check = Session::get('customer_login');
					if($login_check){
						header('Location:order.php');
					}
?>

<?php
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
		$loginCustomer =$cus->login_customer($_POST);
	} 
?>

 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Login</h3>
			<?php
				if(isset($loginCustomer)){
					echo $loginCustomer;
				}
			?>
        	<p>Sign in with the form below.</p>
        	<form class="form" action="" method="POST" id="member">
				<input name="username" type="text"  class="field" placeholder="Enter username" >
				<input name="password" type="password" class="field" placeholder="Enter password" >
        	
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons">
						<div><button tyle="submit" name="login" class="grey">Sign In</button></div>
					</div>
			</form>
        </div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include("include/footer.php");?>
