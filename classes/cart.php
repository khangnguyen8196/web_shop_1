<?php
      $filepath= realpath(dirname(__FILE__));
      include_once($filepath."/../lib/database.php");
      include_once($filepath."/../helpers/format.php");
?>

<?php 
    class cart {

        private $db;
        private $fm;
    

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($quantity,$id){
            $quantity=$this->fm->validation($quantity);
            $quantity= mysqli_real_escape_string($this->db->link,$quantity);
            $id= mysqli_real_escape_string($this->db->link,$id); 
            $sessionId=session_id();

            $query="SELECT * FROM product WHERE productId = '$id'";
            $result=$this->db->select($query)->fetch_assoc();

            $productname=$result['productname'];
            $price=$result['price'];
            $image=$result['image'];

            $query_cart ="SELECT * FROM cart WHERE productId ='$id' AND sessionId ='$sessionId'";
            $check_cart =  $this->db->select($query_cart); 
            if($check_cart){
                $message="The product already added";
                return $message;
            }else{
                $insert_query="INSERT INTO cart (productId,quantity,sessionId,productname,price,image) 
                VALUES ('$id','$quantity','$sessionId','$productname',' $price','$image')";

                $insert_cart=$this->db->insert($insert_query);
                if($insert_cart){
                        header("Location:cart.php");
                }else {
                        header("Location:404.php");
                }   
            }
            
        }

        public function get_product_cart(){
            $sessionId=session_id();
            $query="SELECT * FROM cart WHERE sessionId='$sessionId'";
            $result=$this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity, $cartId){
            $quantity= mysqli_real_escape_string($this->db->link,$quantity);
            $cartId= mysqli_real_escape_string($this->db->link,$cartId);
            $query="UPDATE cart SET 
                    quantity ='$quantity'
                    WHERE cartId='$cartId'";
            $result=$this->db->update($query);
            if($result){
                header('Location:cart.php');
            }else {
                $message='<span class="Product quantity update not successfully!</span>';
                return $message;
            }

        }

        public function delete_product_cart($cartId){
            $query="DELETE FROM cart WHERE cartId = $cartId";
            $result=$this->db->delete($query);
            if($result){
                header('Location:cart.php');
            }else {
                $alert="<span class='error'>Delete not Success!</span> ";
                return $alert;
            }
        }

        public function check_cart(){
            $sessionId=session_id();
            $query="SELECT * FROM cart WHERE sessionId='$sessionId'";
            $result=$this->db->select($query);
            return $result;
        }

       
    }
?>