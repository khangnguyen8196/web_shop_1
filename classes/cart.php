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
        public function insert_order($customerId){
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
                    $customer_id=$customerId;
                    $query_order="INSERT INTO orders (productId,quantity,productname,price,image,customerId) 
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

        public function get_amount_price($customerId){
            $query="SELECT price FROM orders WHERE customerId='$customerId'";
            $get_price=$this->db->select($query);
            return $get_price;
        }
        //order detail
        public function get_cart_ordered($customerId){
            $query="SELECT * FROM orders WHERE customerId='$customerId'";
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

        public function check_order($customerId){
            $query="SELECT * FROM orders WHERE customerId='$customerId'";
            $result=$this->db->select($query);
            return $result;
        }

        // inbox cart admin
        public function get_inbox_cart(){
            $query="SELECT * FROM orders  ORDER BY date_order";
            $result=$this->db->select($query);
            return $result;
        }

        public function shifted($id,$price,$time){
            $id= mysqli_real_escape_string($this->db->link,$id);
            $price= mysqli_real_escape_string($this->db->link,$price);
           
            $query="UPDATE orders SET 
                    status ='1'
                    WHERE orderId='$id' AND price='$price' AND date_order='$time'";
            $result=$this->db->update($query);
            if($result){
                $message='<span class="success">Update order successfully!</span>';
                return $message;
            }else {
                $message='<span class="error">Update order not successfully!</span>';
                return $message;
            }
        }

        public function del_shifted($id,$price,$time){
            $id= mysqli_real_escape_string($this->db->link,$id);
            $price= mysqli_real_escape_string($this->db->link,$price);
           
            $query="DELETE FROM orders
                    WHERE orderId='$id' AND price='$price' AND date_order='$time'";
            $result=$this->db->update($query);
            if($result){
                $message='<span class="success">Delete order successfully!</span>';
                return $message;
            }else {
                $message='<span class="error">Delete order not successfully!</span>';
                return $message;
            }
        }

        public function shifted_confirm($id,$price,$time){
            $id= mysqli_real_escape_string($this->db->link,$id);
            $price= mysqli_real_escape_string($this->db->link,$price);
           
            $query="UPDATE orders SET 
                    status ='2'
                    WHERE orderId='$id' AND price='$price' AND date_order='$time'";
            $result=$this->db->update($query);
            if($result){
                $message='<span class="success">Update order successfully!</span>';
                return $message;
            }else {
                $message='<span class="error">Update order not successfully!</span>';
                return $message;
            }
        }
           
    }
?>