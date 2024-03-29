﻿<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php
    $product =new product();
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
       
		$insertProduct=$product->insert_product($_POST , $_FILES);
    }
		
	
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">   
        <?php if(isset($insertProduct)){
                    echo $insertProduct;
                } ?>            
         <form action="productadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productname" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="categoryId">
                            <option>Select Category</option>
                            <?php 
                                $cat = new category;
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result= $catlist->fetch_assoc()){
                                  ?>     
                                    <option value="<?php echo $result['categoryId'] ?>"><?php echo $result['catname'] ?></option>
                               <?php    }

                                }
                            ?>
                           
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandId">
                            <option>Select Brand</option>
                            <?php 
                                $brand = new brand;
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    foreach($brandlist as $key =>$result){
                                  ?>     
                                    <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandname'] ?></option>
                               <?php    }

                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea id="description" class="tinymce" name="description"></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="file" name="image" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="../admin/resources/ckeditor/ckeditor.js"></script> 
<script type="text/javascript">
        CKEDITOR.replace('description');
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


