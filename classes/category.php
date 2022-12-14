<?php
    $filepath= realpath(dirname(__FILE__));
    include_once($filepath."/../lib/database.php");
    include_once($filepath."/../helpers/format.php");
?>

<?php 
    class category {

        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_category($name){
            $name=$this->fm->validation($name);
            $name= mysqli_real_escape_string($this->db->link,$name);
        
            if(empty($name)){
                $alert ="<span class='error'>Category must be not empty</span>";
                return $alert;
            }else {
                $query="INSERT INTO category (catname) VALUES ('$name')";
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

        public function show_category(){
            $query="SELECT * FROM category order by categoryId DESC ";
            $result=$this->db->select($query);
            return $result;
        }

        public function getcatbyId($id){
            $query="SELECT * FROM category WHERE categoryId = $id ";
            $result=$this->db->select($query);
            return $result;
        }

        public function update_category($id,$name){
            $name=$this->fm->validation($name);
            $name= mysqli_real_escape_string($this->db->link,$name);
            $id= mysqli_real_escape_string($this->db->link,$id);
        
            if(empty($name)){
                $alert ="<span class='success'>Category must be not empty</span>";
                return $alert;
            }else {
                $query="UPDATE category SET catname ='$name' WHERE categoryId='$id'";
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

        public function delete_category($id){
            $query="DELETE FROM category WHERE categoryId = $id ";
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