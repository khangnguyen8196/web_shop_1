
<?php include("include/header.php");?>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
		$insertCustomer =$cus->insert_customer($_POST);
	} 
?>

 <div class="main">
    <div class="content">
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
				if(isset($insertCustomer)){
					echo $insertCustomer;
				}
			?>
    		<form class="form" action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td>
								<div><input type="text" name="username"  placeholder="Enter name" ></div>
		
								<div><input type="text" name="city"   placeholder="Enter city" ></div>
							
								<div><input type="text" name="zipcode"  placeholder="Enter zip code" ></div>
								
								<div><input type="email" name="email"  placeholder="Enter email" ></div>
							</td>

							<td>
								<div><input type="text" name="address"  placeholder="Enter address" ></div>
						
								<div>
									<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
										<option value="null">--Select a Country--</option>         
										<option value="TP.Hồ Chí Minh">TP.Hồ Chí Minh</option>
										<option value="Bình Dương">Bình Dương</option>
										<option value="Đồng Nai">Đồng Nai</option>
										<option value="Tiền Giang">Tiền Giang</option>
										<option value="Long An">Long An</option>
										<option value="Cần Thơ">Cần Thơ</option>
										<option value="Hà Nội">Hà Nội</option>
									</select>
								</div>		        
			
								<div><input type="text" name="phone"  placeholder="Enter phone"></div>
						
								<div><input type="password" name="password"  placeholder="Enter password"></div>
							</td>
						</tr> 
					</tbody>
				</table> 
		   	<div class="search">
				<div>
					<button type="submit" name="submit" value="create account" class="grey">create account</button>
				</div>
			</div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php include("include/footer.php");?>
