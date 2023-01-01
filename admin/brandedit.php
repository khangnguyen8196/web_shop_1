<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php
   $brand = new brand();
   if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
       echo "<script>window.location='brandlist.php'</script>";
    }else {
        $id=$_GET['brandid'];
    }
   if ($_SERVER['REQUEST_METHOD']=='POST'){
       $name=$_POST['brandname'];
       $updateBrand= $brand -> update_brand($id,$name);

   }

?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
                <?php if(isset($updateBrand)){
                    echo $updateBrand;
                } ?>
               <div class="block copyblock"> 
                <?php 
                    $get_brand_name = $brand->getbrandbyId($id);
                    if($get_brand_name){
                        foreach($get_brand_name as $key => $result) {   
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandname" value="<?php echo $result['brandname']?>" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Edit" />
                            </td>
                        </tr>
                    </table>
                    </form>
               <?php }
                } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>