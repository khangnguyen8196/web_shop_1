﻿<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php
    $product =new product();
    if(!isset($_GET['productid']) || $_GET['productid']==NULL){
        echo "<script>window.location='productlist.php'</script>";
    }else {
        $id=$_GET['productid'];
    }
	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $image_old=$_POST['image_old'];
		$updateProduct=$product->update_product($_POST , $_FILES,$id,$image_old);
    }
		
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">   
        <?php   if(isset($updateProduct)){
                    echo $updateProduct;
        } ?>   
        
        <?php 
            $get_product_by_id = $product->getproductbyId($id);
            if($get_product_by_id){
                while($result_row=$get_product_by_id->fetch_assoc()){  
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productname" value="<?php echo $result_row['productname'] ?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="categoryId" >
                            <option>Select Category</option>
                            <?php 
                                $cat = new category;
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result= $catlist->fetch_assoc()){
                                  ?>     
                                    <option
                                    <?php
                                        if($result['categoryId']==$result_row['categoryId']){ echo 'selected';}
                                     ?>  
                                    value="<?php echo $result['categoryId'] ?>"><?php echo $result['catname'] ?></option>
                               <?php   }

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
                                    <option 
                                    <?php
                                        if($result['brandId']==$result_row['brandId']){ echo 'selected';}
                                     ?>  
                                    value="<?php echo $result['brandId'] ?>"><?php echo $result['brandname'] ?></option>
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
                        <textarea id="description" class="tinymce" name="description" value=""><?php echo $result_row['description'] ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" name="price" value="<?php echo $result_row['price'] ?>" class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input type="hidden" name="image_old" value="<?php echo $result_row['image'] ?>"/> 
                        <img width="120" height="100" src="uploads/<?php echo $result_row['image'] ?>">
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
                            <?php 
                                if($result_row['type']==0){
                            ?>
                            <option value="1">Featured</option>
                            <option selected  value="0">Non-Featured</option>
                            <?php 
                            } else {
                            ?>
                            <option selected value="1">Featured</option>
                            <option  value="0">Non-Featured</option>
                            <?php } ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php }} ?>
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


