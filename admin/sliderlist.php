<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/product.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>STT</th>
					<th>Slider Name</th>
					<th>Slider Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$product =new product();
					$get_slider = $product -> show_slider();
							if($get_slider){
								$i=0;
								while($result_slider=$get_slider->fetch_assoc()){
								$i++
								?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result_slider['slidername'] ?></td>
					<td><img src="uploads/<?php echo $result_slider['sliderimage'] ?>" height="120x" width="500px"/></td>
					<td><?php echo $result_slider['type'] ?></td>				
					<td>
						<a href="?del_slider=<?php echo $result_slider['sliderId'] ?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
					</td>
				</tr>
				<?php 
				}} 
				?>	
			</tbody>
		</table>

       </div>
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
