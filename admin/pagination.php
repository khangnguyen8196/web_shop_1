
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>
<?php include_once '../lib/database.php';?>
<?php
		$fm = new Format();
		$product = new product();
		if(isset($_POST['delete_image'])){
			$productId=$_POST['delete_id'];
			$image=$_POST['del_image'];
			$delProduct=$product->delete_product($productId,$image);
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
		if(!isset($_GET['page']) ){
			$current_page=1;
		}elseif($_GET['page']==0){
			$current_page=1;
		}else{
			$current_page=$_GET['page'];
		}
		$item_page=10;
		$start = ($current_page - 1)*$item_page;
		$count = $product->show_product_all($start,$item_page,['category_id'=>$category_id, 'keyword'=>$keyword, 'count'=>true]);
		$total_page=ceil($count/$item_page);
		// data
		$product_all = $product->show_product_all($start,$item_page,['category_id'=>$category_id, 'keyword'=>$keyword ]);
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
<div class="grid_12">
	<div class="box round first grid">
		<div class="block"> 
            <table class="data display " id="pagination_data">
				
				<div class="search_product">			
					<form action="productlist.php" method="GET">
						<div class="col-md-2">
							<label class="form-label">Category</label>
							<select id="category_id" name="category_id">
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
							<input type="search" id="keyword" class="form-control item-search"  name="keyword" value="<?php  echo $keyword ?>" mapping-column="1" 
							placeholder="Nhập từ khoá...." />

						</div>
						<div class="col-md-2">
								<button class="search" type="submit" name='search'>Search</button>
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

		<?php
			$output = '</table><br /><div align="center">';
			if ($current_page > 1 && $total_page > 1){
				$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".($current_page-1)."'>Prev</span>";
            }
			for($i=1; $i<=$total_page; $i++)  
			{  
				if($i !=$current_page){
					if($i > $current_page - 4 && $i < $current_page +4 ){
						$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
					}
				}else{
					$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'><strong>".$i."</strong></span>";  

				}
			}
			if ($current_page < $total_page && $total_page > 1){
				$output .= "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".($current_page+1)."'>Next</span>";
            }
			$output .= '</div><br /><br />';  
			echo $output;  
		?>  
		<span>Có tất cả <strong><?php echo $count ?></strong> sản phẩm trên <strong><?php echo $total_page ?></strong> trang</span>
</div>	

