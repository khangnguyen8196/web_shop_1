<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php include_once '../lib/database.php';?>
	
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"> -->
    
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
	<script src ="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<?php
		$fm = new Format();
		$product = new product();
		if(isset($_POST['delete_image'])){
			$productId=$_POST['delete_id'];
			$image=$_POST['del_image'];
			$delProduct=$product->delete_product($productId,$image);
		}
		$product_all=$product->getproduct_feathered();
		
?>
<style>
	.search_product{

		display: flex;
		border: 1px solid #999;
		border-radius: 4px;
		padding: 10px;
		margin-bottom: 20px;
		justify-content:space-evenly;
	}
	.header_table {
		background-color: #888;
	}
</style>
<div class="grid_10">
	<div class="box round first grid">
		<div class="block"> 
            <table class="table table-fluid " id="pagination">
				<thead class="header_table">
					<tr>
						<th>STT</th>
						<th>Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Image</th>
						<th>Price</th>
						<th>Type</th>
						<th>Edit</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
					<?php
						if( !empty($product_all)){
							foreach($product_all as $key => $result) { 
					?>
							<tr class="odd gradeX">
								<td><?php echo $key + 1  ?></td>
								<td><?php echo $result['productname'] ?></td>
								<td><?php echo $result['catname'] ?></td>
								<td><?php echo $result['brandname'] ?></td>
								<td><?php echo $fm->textShorten($result['description'],30)  ?></td>
								<td> <img width="100" height="100" src="uploads/<?php echo $result['image'] ?>"></td>
								<td><?php echo $result['price'] ?></td>
								<td><?php if($result['type']==0){
									echo 'Non-Featured';
								} else {
									echo 'Featured';
								}
								?></td>
								<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> </td>
								<td>
									<form action="" method ="POST">
										<input type="hidden" name="delete_id" value="<?php echo $result['productId'] ?>">
										<input type="hidden" name="del_image" value="<?php echo $result['image'] ?>">
										<button type="submit" name="delete_image">Delete</button>
									</form>
								</td>
							</tr>
					<?php 
							}
						}
					?>
				</tbody>
			</table>
	
		</div>
	</div>	
</div>
<script>
	$(document).ready( function () {
		
			$('#pagination').DataTable({

			});
		
   	 	
	} );
</script>

