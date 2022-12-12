<?php
    include("../lib/session.php");
        Session::checkLogin();
    include("../lib/database.php");
    include("../helpers/format.php");
?>

<?php 
    class adminLogin {

        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function login_admin($username,$password){
            $username=$this->fm->validation($username);
            $password=$this->fm->validation($password);

            $username= mysqli_real_escape_string($this->db->link,$username);
            $password= mysqli_real_escape_string($this->db->link,$password);

            if(empty($username)||empty($password)){
                $alert ="User and Pass must be not empty";
                return $alert;
            }else {
                $query="SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1";
                $result=$this->db->select($query);

                if($result!=false){
                    $value =$result->fetch_assoc();
                    
                    Session::set('adminLogin',true);

                    Session::set('id',$value['id']);
                    Session::set('username',$value['username']);
                    Session::set('fullname',$value['fullname']);
                    header('location:index.php');
                }else{
                    $alert ="User and Pass not match";
                    return $alert;
                }
            }
        }
    }
?>