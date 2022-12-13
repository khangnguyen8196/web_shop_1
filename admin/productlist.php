<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php
		$fm = new Format();
		$product = new product();
		if(isset($_GET['delid'])){
			$id=$_GET['delid'];
			$delProduct=$product->delete_product($id);
	
		}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Product list</h2>
        <div class="block"> 
			<?php
				if(isset($delProduct)){
					echo  $delProduct ;
				}
			?>  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Image</th>
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$productList = $product->show_product();
				if($productList){
					$i=0;
					while($result=$productList->fetch_assoc()){
					$i++;
				?>
				
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
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
					<td><a href="productedit.php?productid=<?php echo $result['id'] ?>">Edit</a> || 
					<a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['id']?>">Delete</a></td>
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
