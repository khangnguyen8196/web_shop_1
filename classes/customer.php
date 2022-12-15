<?php
     $filepath= realpath(dirname(__FILE__));
     include_once($filepath."/../lib/database.php");
     include_once($filepath."/../helpers/format.php");
?>

<?php 
    class customer {

        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_customer($data){
            $username= mysqli_real_escape_string($this->db->link,$data['username']); 
            $email= mysqli_real_escape_string($this->db->link,$data['email']); 
            $password= mysqli_real_escape_string($this->db->link,md5($data['password'])); 
            $city= mysqli_real_escape_string($this->db->link,$data['city']); 
            $address= mysqli_real_escape_string($this->db->link,$data['address']); 
            $phone= mysqli_real_escape_string($this->db->link,$data['phone']); 
            $country= mysqli_real_escape_string($this->db->link,$data['country']); 
            $zipcode= mysqli_real_escape_string($this->db->link,$data['zipcode']);
            $level="1";
            if($username =="" || $email =="" || $password =="" || $city =="" 
            || $address =="" || $phone =="" || $country =="" || $zipcode ==""){
                $alert ="<span class='error'> Fields must be not empty</span>";
                    return $alert;
            
            // if(empty($username) || empty($email) || empty($password) || empty($city)
            // || empty($address) || empty($phone) || empty($country) || empty($zipcode)){
            //     $alert ="<span class='error'> Fields must be not empty</span>";
            //     return $alert;
            }else{
                $check_email ="SELECT * FROM users WHERE email = '$email' LIMIT 1";
                $result_check_email=$this->db->select($check_email);
                if($result_check_email){
                    $alert= "<span class='error'> Email already existed! Please Enter ?Another Email</span>";
                    return $alert;
                }else {
                    $query="INSERT INTO users (username,email,password,
                    city,address,phone,country,zipcode,level) 
                    VALUES ('$username','$email','$password',' $city',
                    '$address','$phone','$country','$zipcode','$level')";
                    $result=$this->db->insert($query);
                    if ($result){
                        $alert= "<span class='success'> Create account successfully!</span>";
                        return $alert;
                    }else {
                        $alert= "<span class='error'> Create account not successfully!</span>";
                        return $alert;
                    }
                }
            } 
        }

        public function login_customer($data){
            $username=mysqli_real_escape_string($this->db->link,$data['username']); 
            $password=mysqli_real_escape_string($this->db->link,md5($data['password']));
            if($username ==""|| $password ==""  ){
                $alert ="<span class='error'> Fields must be not empty</span>";
                    return $alert;
            }else{
                $check_login ="SELECT * FROM users WHERE username = '$username' 
                AND password = '$password' LIMIT 1";
                $result_check_login=$this->db->select($check_login);
                if($result_check_login!=false){
                    $value=$result_check_login->fetch_assoc();
                    Session::set('customer_login',true);
                    Session::set('customer_id', $value['id']);
                    Session::set('customer_username', $value['username']);
                    header("Location:order.php");
                }else {
                    $alert= "<span class='error'> Username or Password doesn't match !</span>";
                    return $alert;
                }
                
            }  
        }

       
    }
?>