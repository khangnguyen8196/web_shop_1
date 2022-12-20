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
		$keyword=(isset($_GET['keyword']))?$_GET['keyword']:null;	
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
								<div class="col-md-4">
									<label class="form-label">Name</label>
									<input type="text" class="form-control item-search"  name="keyword" value="<?php echo $keyword ?>" mapping-column="1" 
									placeholder="Nhập từ khoá...." value="" >

								</div>
								<div class="col-md-2">
										<button class="" type="submit" name='search'>Search</button>
								</div>
								<!-- <div class="col-md-2">
									<label class="form-label">Status</label>
									<select class="form-select form-select-md item-search" item-type="search" name="status" mapping-column="3" fdprocessedid="tc8lo9">
										<option value="">All</option>
										<option value="1">Active</option>
										<option value="2">Inactive</option>
									</select>
								</div> -->
								<div class="col-md-2">
									<label class="form-label">Category</label>
									<select class="form-select form-select-md item-search" item-type="search" name="category" mapping-column="7" fdprocessedid="zjys9">
										<option>All</option>
										<?php 
										$cat = new category;
										$catlist = $cat->show_category();
										if($catlist){
											while($result= $catlist->fetch_assoc()){
										?>     
											<option value="<?php echo $result['categoryId'] ?>"><?php echo $result['catname'] ?></option>
										<?php    
										}
                                		}
                           				?>
									</select>
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
				$product_search = $product->search_product();
				if($product_search){
					$i=0;
					while($result=$product_search->fetch_assoc()){
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
					<td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Edit</a> || 
					<a onclick="return confirm('Are you want to delete?')" href="?delid=<?php echo $result['productId']?>">Delete</a></td>
				</tr>
				<?php }
				}
				?>
			</tbody>
			</table>
		</div>
    </div>
	<div>
		<!-- <h5>Phân trang:</h5> -->
		<?php
			$item_page=10;
			if(!isset($_GET['page']) ){
                $current_page=1;
            }elseif($_GET['page']==0){
                $current_page=1;
            }else{
                $current_page=$_GET['page'];
            }
			if(!isset($_GET['keyword'])){
				$keyword='';
			}else {
				$keyword=$_GET['keyword'];
			}
			// $keyword= isset($_GET['keyword']) ? $_GET['keyword'] : '';
			$start = ($current_page - 1)*$item_page;
			$product_all = $product->show_product_all();
			$product_count = mysqli_num_rows($product_all);
			$total_page=ceil($product_count/$item_page);
			echo "<h5>Trang</h5>";
			if ($current_page > 1 && $total_page > 1){
                echo '<a href="productlist.php?page='.($current_page-1).''.(($keyword!='')?"&keyword=$keyword":'').'">Prev</a> | ';
            }
			for($i=1;$i<=$total_page;$i++){
				if($i !=$current_page){?> 

					   <?php echo '<a class="product_button" style="margin:0 5px" href="productlist.php?page='.$i.''.(($keyword!='')?"&keyword=$keyword":'').'">'.$i.'</a>'; ?>
			   <?php } 
					   else {?>
				   <?php echo '<strong >'.$i.'</strong>' ?>

			   <?php } ?>
				  
		   <?php }
			if ($current_page < $total_page && $total_page > 1){
                echo '|<a href="productlist.php?page='.($current_page+1).''.(($keyword!='')?"&keyword=$keyword":'').'">Next</a> ';
            }
		?>

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
