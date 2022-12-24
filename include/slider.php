<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php 
					$getLastestHp =$product->getLastestHp();
					if(isset($getLastestHp)){
						foreach($getLastestHp as $key => $result){
				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="detail.php?proid=<?php echo $result['productId']; ?>"> 
							<img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" />
							</a>
						</div>
						<div class="text list_2_of_1">
							<h2>HP</h2>
							<p><?php echo $fm->textShorten($result['description'],20)?></p>
							<div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
			   <?php
			   		}		
					}
				?>
				
				<?php 
					$getLastestAsus =$product->getLastestAsus();
					if(isset($getLastestAsus)){
						foreach($getLastestAsus as $key => $result){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="detail.php?proid=<?php echo $result['productId']; ?>">
						  <img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Asus</h2>
						  <p><?php echo $fm->textShorten($result['description'],20)?></p>
						  <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   		}		
					}
				?>
			</div>

			<div class="section group">
				<?php 
					$getLastestIphone =$product->getLastestIphone();
					if(isset($getLastestIphone)){
						foreach($getLastestIphone as $key => $result){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="detail.php?proid=<?php echo $result['productId']; ?>">
						<img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" />
						</a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $fm->textShorten($result['description'],20)?></p>
						<div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
			   		}		
					}
				?>
			   
			   <?php 
					$getLastestSamsung =$product->getLastestSamsung();
					if(isset($getLastestSamsung)){
						foreach($getLastestSamsung as $key => $result){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="detail.php?proid=<?php echo $result['productId']; ?>">
						<img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" />
						</a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $fm->textShorten($result['description'],20)?></p>
						  <div class="button"><span><a href="detail.php?proid=<?php echo $result['productId']; ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   		}		
					}
				?>
			</div>
		  <div class="clear"></div>
		</div>
	<div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php 
							$get_slider = $product -> show_slider();
							if($get_slider){
								while($result_slider=$get_slider->fetch_assoc()){?>

						<li><img width="180px" height="100px" src="admin/uploads/<?php echo $result_slider['sliderimage'] ?>" alt="<?php echo $result_slider['slidername'] ?>"/></li>
						
							<?php	
								}
							}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  	<div class="clear"></div>
</div>

