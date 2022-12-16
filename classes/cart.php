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
        //logout
        public function del_all_cart(){
            $sessionId=session_id();
            $query="DELETE FROM cart WHERE sessionId='$sessionId'";
            $result=$this->db->select($query);
            return $result;
        }
        // order 
        public function insert_order($userId){
            $sessionId=session_id();
            $query="SELECT * FROM cart WHERE sessionId='$sessionId'";
            $get_product=$this->db->select($query);
            if($get_product){
                while($result=$get_product->fetch_assoc()){
                    $productId=$result['productId'];
                    $productname=$result['productname'];
                    $quantity=$result['quantity'];
                    $price=$result['price'] * $quantity;
                    $image=$result['image'];
                    $customer_id=$userId;
                    $query_order="INSERT INTO orders (productId,quantity,productname,price,image,userId) 
                    VALUES ('$productId','$quantity','$productname',' $price','$image','$customer_id')";
                    $insert_order=$this->db->insert($query_order);
                    // if($insert_order){
                    //         header("Location:order.php");
                    // }else {
                    //         header("Location:404.php");
                    // }  
                }
            }
        }

        public function get_amount_price($userId){
            $query="SELECT price FROM orders WHERE userId='$userId'";
            $get_price=$this->db->select($query);
            return $get_price;
        }

        public function get_cart_ordered($userId){
            $query="SELECT * FROM orders WHERE userId='$userId'";
            $get_cart=$this->db->select($query);
            return $get_cart;
        }

        public function del_cart_order($id){
            $query="DELETE FROM orders WHERE orderId = $id";
            $result=$this->db->delete($query);
            if($result){
                header('Location:orderdetail.php');
            }else {
                $alert="<span class='error'>Delete not Success!</span> ";
                return $alert;
            }
        }

        public function check_order($userId){
            $query="SELECT * FROM orders WHERE userId='$userId'";
            $result=$this->db->select($query);
            return $result;
        }
        

       
    }
?>