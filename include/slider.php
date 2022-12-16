<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php 
					$getLastestHp =$product->getLastestHp();
					if(isset($getLastestHp)){
						while($result=$getLastestHp->fetch_assoc()){
				?>
					<div class="listview_1_of_2 images_1_of_2">
						<div class="listimg listimg_2_of_1">
							<a href="detail.php?proid=<?php echo $result['productId']; ?>"> 
							<img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" />
							</a>
						</div>
						<div class="text list_2_of_1">
							<h2>HP</h2>
							<p><?php echo $fm->textShorten($result['description'],40)?></p>
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
						while($result=$getLastestAsus->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="detail.php?proid=<?php echo $result['productId']; ?>">
						  <img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Asus</h2>
						  <p><?php echo $fm->textShorten($result['description'],40)?></p>
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
						while($result=$getLastestIphone->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="detail.php?proid=<?php echo $result['productId']; ?>">
						<img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" />
						</a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $fm->textShorten($result['description'],40)?></p>
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
						while($result=$getLastestSamsung->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="detail.php?proid=<?php echo $result['productId']; ?>">
						<img src="../admin/uploads/<?php echo $result['image'] ?>" alt="image" />
						</a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Samsung</h2>
						  <p><?php echo $fm->textShorten($result['description'],40)?></p>
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
						<li><img src="images/1.jpg" alt=""/></li>
						<li><img src="images/2.jpg" alt=""/></li>
						<li><img src="images/3.jpg" alt=""/></li>
						<li><img src="images/4.jpg" alt=""/></li>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  	<div class="clear"></div>
</div>