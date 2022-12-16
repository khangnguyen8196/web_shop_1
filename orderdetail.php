
<?php include("include/header.php");?>

<?php 
   $login_check = Session::get('customer_login');
   if($login_check==false){
      header("location:login.php");
   }
   if(isset($_GET['cartId'])){
      $id=$_GET['cartId'];
      $del_cart_order=$cart->del_cart_order($id);
   }
?>

<style>
	.cart_order {
    overflow: hidden;
    padding: 10px;
	}
	.box_left {
		width: 100%;
		border:1px solid #333;
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
    		<h2>Your Details Ordered</h2>
    		</div>
    		<div class="clear"></div>
    	<div class="section group">
            <?php if(isset($del_cart_order)){
							echo $del_cart_order ;
						}?>
				<div class="box_left">
					<div class="cart_order">

                  <table class="tblone">
							<tr>
                        <th width="5%">STT</th>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="25%">Price</th>
								<th width="10%">Quantity</th>
								<th width="10%">Date</th>
								<th width="10%">Status</th>
								<th width="10%">Action</th>
							</tr>
							<?php 
                     	$userId=Session::get('customer_id');
								$get_cart_ordered=$cart->get_cart_ordered($userId);
								if($get_cart_ordered){
                           $i=0;
									while($result=$get_cart_ordered->fetch_assoc()){
                           $i++;
								?>	
								<tr>
									<td><?php echo $i ?></td>
									<td><?php echo $result['productname'];?></td>
									<td><img src="admin/uploads/<?php echo $result['image'];?>" alt=""/></td>
									<td><?php echo $result['price']." "."VNĐ" ?></td>
									<td>	
											<?php echo $result['quantity'];?>
									</td>
                           <td><?php echo $fm->formatDate($result['date_order']);?></td>
                           <td>
                              <?php
                                 if($result['status']==0){
                                    echo 'Pending';
                                 }else {
                                    echo 'processed';
                                 }
                              ?>
                           </td>
                           <?php
                              if($result['status']==0){
                           ?>
                              <td><?php echo 'N/A'; ?></td> 
                            <?php  
                            }else {
                           ?>
									<td><a onclick="return confirm('Are you want to delete?')" href="?cartId=<?php echo $result['orderId']?>">Xoá</a></td>
                           <?php
                              }
                            ?>
                        </tr>
							<?php 
							 }}
							?>
						</table>	
					</div>
				</div>
            <div class="shopping">
               <div class="shopleft">
            <a href="index.php"> <img src="images/shop.png" alt="" /></a>
         </div>
		</div>
		</div>
 	</div>
	</form>
</div>
<?php include("include/footer.php");?>
