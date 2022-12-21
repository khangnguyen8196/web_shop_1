<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php include_once '../lib/database.php';?>
<?php
		$fm = new Format();
		$product = new product();
		if(isset($_GET['delid'])){
			$id=$_GET['delid'];
			$delProduct=$product->delete_product($id);	
		}
		$keyword='';
		$category_id=0;
		if(isset($_GET['category_id'])){
			$category_id=(int)$_GET['category_id'];
		}
		if(isset($_GET['keyword'])){
			$keyword=$_GET['keyword'];
		}
		// total
		$item_page=5;
		if(!isset($_GET['page']) ){
			$current_page=1;
		}elseif($_GET['page']==0){
			$current_page=1;
		}else{
			$current_page=$_GET['page'];
		}
		
		$start = ($current_page - 1)*$item_page;
		$count = $product->show_product_all(['category_id'=>$category_id, 'keyword'=>$keyword, 'count'=>true]);
		$total_page=ceil($count/$item_page);
		// data
		$product_all = $product->show_product_all(['category_id'=>$category_id, 'keyword'=>$keyword ]);
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
        <h2>Product list</h2>
        <div class="block"> 
			<?php
				if(isset($delProduct)){
					echo  $delProduct ;
				}
			?>  
            <table class="data display " id="example">
				
					<div class="search_product">
							
							
							<form action="productlist.php" method="GET">
								<div class="col-md-2">
									<label class="form-label">Category</label>
									<select name="category_id">
										<option value="">ALL</option>
										<?php 
											$cat = new category;
											$catList = $cat-> get_list_category();
											if(!empty($catList)){
												foreach($catList as $cat){
													?>
														<option <?php if(isset($category_id) && $category_id ==$cat['id']) {echo 'selected="selected"';}  ?> value="<?php echo $cat['id'] ?>"><?php echo $cat['name'] ?></option>
													<?php	
												}

											}
										?>
									</select>
								</div>
								<div class="col-md-4">
									<label class="form-label">Name</label>
									<input type="text" class="form-control item-search"  name="keyword" value="<?php  echo $keyword ?>" mapping-column="1" 
									placeholder="Nhập từ khoá...." value="" >

								</div>
								<div class="col-md-2">
										<button class="" type="submit" name='search'>Search</button>
								</div>
							</form>
					</div>
				
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
					<th>Action</th>
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
							<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || 
							<a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['productId']?>">Delete</a></td>
						</tr>
				<?php 
						}
					}
				?>
			</tbody>
			</table>
		</div>
    </div>
	<div>
		<!-- <h5>Phân trang:</h5> -->
		<?php
			
			echo "<h5>Trang</h5>";
			if ($current_page > 1 && $total_page > 1){
                echo '<a href="productlist.php?page='.($current_page-1).''.(($category_id!='')?"&category_id=$category_id":'').''.(($keyword!='')?"&keyword=$keyword":'').'">Prev</a> | ';
            }
			for($i=1;$i<=$total_page;$i++){
				if($i !=$current_page){?> 

					   <?php echo '<a class="product_button" style="margin:0 5px" href="productlist.php?page='.$i.''.(($category_id!='')?"&category_id=$category_id":'').''.(($keyword!='')?"&keyword=$keyword":'').'">'.$i.'</a>'; ?>
			   <?php } 
					   else {?>
				   <?php echo '<strong >'.$i.'</strong>' ?>

			   <?php } ?>
				  
		   <?php }
			if ($current_page < $total_page && $total_page > 1){
                echo '|<a href="productlist.php?page='.($current_page+1).''.(($category_id!='')?"&category_id=$category_id":'').''.(($keyword!='')?"&keyword=$keyword":'').'">Next</a> ';
            }
		?>

	</div>
	<div>
		<span>Có tất cả <strong><?php echo $count ?></strong> sản phẩm trên <strong><?php echo $total_page ?></strong> trang</span>
	</div>
</div>

<!-- <script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script> -->
<?php include 'inc/footer.php';?>
