<?php include("include/header.php");?>

<?php
				$login_check = Session::get('customer_login');
					if($login_check==false){
						header('Location:login.php');
					}
?>

<style>
   .order_page {
      font-size: 30px;
      font-weight: 500;
      color: red;
   }
</style>
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
                <div class="order_page">
                        <h3>Order page</h3>
                </div>
			</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include("include/footer.php");?>