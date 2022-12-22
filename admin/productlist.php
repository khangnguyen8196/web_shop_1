<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php include_once '../lib/database.php';?>

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
        <h2>Product list</h2>
        <div class="block"> 
            <table class="data display " id="pagination_data">
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
        $(document).ready(function(){  
        load_data();  
			function load_data(page, keyword='',category_id) 
			{  
				var keyword =$('#keyword').val(); 
				var category_id = $('#category_id').val();
				$.ajax({  
						url:"pagination.php",  
						method:"GET",  
						data:{page:page,keyword:keyword,category_id:category_id},  
						success:function(data){  
							$('#pagination_data').html(data);  
						}  
				})  
			}
			if("category_id"&&"keyword"&& "page"){
				$(document).on('click', ('.pagination_link'), function(){  
					var page = $(this).attr("id"); 
					load_data(page);  
				});
				$('#keyword').keyup(function(){
				var keyword = $('#keyword').val();
				load_data(1,keyword);
				});
				$(document).on('click', ('.search'), function(){
					var page = $(this).attr("id");   
					var keyword = $('#keyword').val(); 
					load_data(page,keyword,category_id);  
				});
			} 
        });  
    </script> 
<?php include 'inc/footer.php';?>
