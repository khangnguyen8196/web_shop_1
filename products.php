
<?php include("include/header.php");?>
<?php include("include/slider.php");?>

    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Điện thoại di động</h3>
    		</div>
    		<div class="clear"></div>
			<div class="section group">
			<?php 	
					$get_cat_1 = $product->get_cat_1();
					if(!empty($get_cat_1)){
						foreach($get_cat_1 as $key => $result){
			?>
			  <div class="grid_1_of_5 images_1_of_5">
				   <a href="detail.php?proid=<?php echo $result['productId']; ?>">
				   <img with="140px" height="140px" src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
				   <h2><?php echo $result['productname']; ?></h2>
				   <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></p>
				   <p><?php echo $fm->textShorten($result['description'],40)?></p>
				   <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
			  </div>
			<?php
			   	}		
				}
			?>
		  </div>
    	</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Phụ kiện</h3>
    		</div>
    		<div class="clear"></div>
			<div class="section group">
			<?php 
					$get_cat_2 = $product->get_cat_2();
					if(!empty($get_cat_2)){
						foreach($get_cat_2 as $key => $result){
			?>
				<div class="grid_1_of_5 images_1_of_5">
					 <a href="detail.php?proid=<?php echo $result['productId']; ?>">
					 <img with="140px" height="140px" src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					 <h2><?php echo $result['productname']; ?></h2>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></p>
					 <p><?php echo $fm->textShorten($result['description'],40)?></p>
				     <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
			   	}		
				}
			?>
			</div>
    	</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Thiết bị điện tử</h3>
    		</div>
    		<div class="clear"></div>
			<div class="section group">
			<?php 
					$get_cat_3 = $product->get_cat_3();
					if(!empty($get_cat_3)){
						foreach($get_cat_3 as $key => $result){
			?>
				<div class="grid_1_of_5 images_1_of_5">
					<a href="detail.php?proid=<?php echo $result['productId']; ?>">
					<img with="140px" height="140px" src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					<h2><?php echo $result['productname']; ?></h2>
					<p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></p>
				    <p><?php echo $fm->textShorten($result['description'],40)?></p>
				    <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php
			   	}		
				}
			?>
			</div>
    	</div>
		<div class="content_bottom">
    		<div class="heading">
    		<h3>Máy tính</h3>
    		</div>
    		<div class="clear"></div>
			<div class="section group">
			<?php 
					$get_cat_4 = $product->get_cat_4();
					if(!empty($get_cat_4)){
						foreach($get_cat_4 as $key => $result){
			?>
				<div class="grid_1_of_5 images_1_of_5">
					<a href="detail.php?proid=<?php echo $result['productId']; ?>">
					<img with="140px" height="140px" src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					<h2><?php echo $result['productname']; ?></h2>
					<p><span class="price"><?php echo $fm->format_currency($result['price'])." "."VNĐ" ?></span></p>
				    <p><?php echo $fm->textShorten($result['description'],40)?></p>
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
