<?php 
	 if(!isset($_GET['categoryId']) || $_GET['categoryId']==NULL){
		echo "<script>window.location='404.php'</script>";
	 }else {
		 $id=$_GET['categoryId'];
	 }
?>
<?php
	// if($_SERVER['REQUEST_METHOD'] == 'POST'){
    //    $catname=$_POST['catname'];
	// 	$updateCat=$cat->update_category($catname,$id);
    // }
?>


<?php include("include/header.php");?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
		<?php 
				$name_cat =$cat->get_name_by_cat($id);
				if($name_cat){
					while($result_name=$name_cat->fetch_assoc()){
		?>
    		<div class="heading">
    		<h3><?php echo $result_name['catname'] ?></h3>
    		</div>
		<?php	
			}
			}else {
				echo "<span class='error'>Category not have product!</span>";
			}
		?>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php 
				$productbycat =$cat->get_product_by_cat($id);
				if($productbycat){
					while($result=$productbycat->fetch_assoc()){
				?>
			
				<div class="grid_1_of_5 images_1_of_5">
					 <a href="detail.php?proid=<?php echo $result['productId']; ?>"><img width="207px" height="207px" src="admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					 <h2><?php echo $result['productname'] ?></h2>
					 <p><?php echo $fm->textShorten($result['productname'], 50)?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price']." "."VNĐ") ?></span></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php	
				}
				}
				?>
			</div>

	
	
    </div>
 </div>
 <?php include("include/footer.php");?>
