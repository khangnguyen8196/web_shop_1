<?php
    include_once("../lib/database.php");
    include_once("../helpers/format.php");
?>

<?php 
    class brand {

        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_brand($name){
            $name=$this->fm->validation($name);
            $name= mysqli_real_escape_string($this->db->link,$name);
        
            if(empty($name)){
                $alert ="<span class='error'>brand must be not empty</span>";
                return $alert;
            }else {
                $query="INSERT INTO brand (brandname) VALUES ('$name')";
                $result=$this->db->insert($query);
                if($result){
                    $alert="<span class='success'>Insert Success!</span> ";
                    return $alert;
                }else {
                    $alert="<span class='error'>Insert not Success!</span> ";
                    return $alert;
                }

            }
        }

        public function show_brand(){
            $query="SELECT * FROM brand order by id DESC ";
            $result=$this->db->select($query);
            return $result;
        }

        public function getbrandbyId($id){
            $query="SELECT * FROM brand WHERE id = $id ";
            $result=$this->db->select($query);
            return $result;
        }

        public function update_brand($id,$name){
            $name=$this->fm->validation($name);
            $name= mysqli_real_escape_string($this->db->link,$name);
            $id= mysqli_real_escape_string($this->db->link,$id);
        
            if(empty($name)){
                $alert ="<span class='success'>brand must be not empty</span>";
                return $alert;
            }else {
                $query="UPDATE brand SET brandname ='$name' WHERE id='$id'";
                $result=$this->db->update($query);
                if($result){
                    $alert="<span class='success'>Update Success!</span> ";
                    return $alert;
                }else {
                    $alert="<span class='error'>Update not Success!</span> ";
                    return $alert;
                }

            }
        }

        public function delete_brand($id){
            $query="DELETE FROM brand WHERE id = $id ";
            $result=$this->db->delete($query);
            if($result){
                $alert="<span class='success'>Delete Success!</span> ";
                return $alert;
            }else {
                $alert="<span class='error'>Delete not Success!</span> ";
                return $alert;
            }
        }
    }
?>