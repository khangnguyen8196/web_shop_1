<?php include("include/header.php");?>
<?php 
	 if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
		$customerId=Session::get('customer_id');
		// $insertOrder=$cart->insert_order($customerId);
		// $delCart =$cart->del_all_cart();
		header('location:success.php');
	 }
?>

<style>
   .success_order {
      font-weight: 500;
      color: red !important;
      text-align: center;
   }
   .success_note{
      text-align: center;
   }
</style>
<div class="main">
   <form action="" method="POST">
   <div class="content">
    	<div class="section group">		
            <h2 class="success_order"> Success Order !</h2>
            <?php 
               $customerId=Session::get('customer_id');
               $get_amount=$cart->get_amount_price($customerId);
               if($get_amount){
                  $amount=0;
                  while($result=$get_amount->fetch_assoc()){
                     $price = $result['price'];
                     $amount +=$price;
                  
                  }
               }
            ?>
            <p class="success_note">
               Total Price you Have Bought From My Website:
               <?php 
                  $vat= $amount * 0.1 ; 
                  $total =$amount + $vat;
                  echo $total." "."VNĐ";
               ?>
            </p>
            <p class="success_note">We will contact as soon possible. Please see your order details here
               <a href="orderdetail.php">Click here!</a>
            </p>
         
    	</div>  	
       <div class="clear"></div>
   </div>
   </form>
 </div>
 <?php include("include/footer.php");?>