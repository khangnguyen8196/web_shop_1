<?php include_once 'inc/header.php';?>
<?php include_once 'inc/sidebar.php';?>
<?php 	
    $filepath= realpath(dirname(__FILE__));
	include_once($filepath."/../classes/customer.php");
	include_once($filepath."/../helpers/format.php");
?>
<?php
    $cus =new customer();
    if(!isset($_GET['customerId']) || $_GET['customerId']==NULL){
        echo "<script>window.location='inbox.php'</script>";
    }else {
        $id=$_GET['customerId'];
    }
    
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Customer</h2>
                <?php if(isset($updateCat)){
                    echo $updateCat;
                } ?>
               <div class="block copyblock"> 
                <?php 
                    $get_customer=$cus->show_customer($id);
                    if($get_customer){
                        while($result=$get_customer->fetch_assoc()){   
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="username" value="<?php echo $result['username']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="email" value="<?php echo $result['email']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Fullname</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="fullname" value="<?php echo $result['fullname']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="country" value="<?php echo $result['country']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zip Code</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="zipcode" value="<?php echo $result['zipcode']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone Number</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="phone" value="<?php echo $result['phone']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="address" value="<?php echo $result['address']?>" placeholder="Enter Category Name..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" name="city" value="<?php echo $result['city']?>" placeholder="Enter Category Name..." class="medium" />
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