<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
	$filepath= realpath(dirname(__FILE__));
	include_once($filepath."/../classes/cart.php");
	include_once($filepath."/../helpers/format.php");
?>
<?php 
	$cart= new cart();
	if(isset($_GET['shiftid'])){
		$id=$_GET['shiftid'];
		$price=$_GET['price'];
		$time=$_GET['time'];
		$shifted=$cart->shifted($id,$price,$time);
	}

	if(isset($_GET['delid'])){
		$id=$_GET['delid'];
		$price=$_GET['price'];
		$time=$_GET['time'];
		$del_shifted=$cart->del_shifted($id,$price,$time);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">
					<?php
						if(isset($shifted)){
							echo $shifted;
						}
						if(isset($del_shifted)){
							echo $del_shifted;
						}
					?>   
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>STT</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>CustomerID</th>
							<th>Address</th>
							<th>Order Time</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$cart= new cart();
							$fm= new Format();
							$get_inbox_cart=$cart->get_inbox_cart();
							if($get_inbox_cart){
								$i=0;
								while($result=$get_inbox_cart->fetch_assoc()){
								$i++;
							?>		
						
						<tr class="odd gradeX">
							<td><?php echo $i?></td>
							<td><?php echo $result['productname']?></td>
							<td><?php echo $result['quantity']?></td>
							<td><?php echo $fm->format_currency($result['price']." "."VNĐ")?></td>
							<td><?php echo $result['customerId']?></td>
							<td><a href="customer.php?customerId=<?php echo $result['customerId']?>">View Customer</a></td>
							<td><?php echo $fm->formatDate($result['date_order']) ?></td>
							<td>
								<?php
									if($result['status'] ==0){
									?>
									<a href="?shiftid=<?php echo $result['orderId']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?> 
									">Pending</a>
								<?php
									}elseif($result['status'] ==1){
								?>
										<?php echo 'Shifting....';?>

								<?php }elseif($result['status']==2){
								?>
									<a href="?delid=<?php echo $result['orderId']?>&price=<?php echo $result['price']?>&time=<?php echo $result['date_order']?>
									">Remove</a>
								<?php }
								?>
							</td>
						</tr>
						<?php }
							}
						?>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
