<?php
    $filepath= realpath(dirname(__FILE__));
    include_once($filepath."/../lib/database.php");
    include_once($filepath."/../helpers/format.php");
?>

<?php 
    class product {

        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data, $files){

            $name= mysqli_real_escape_string($this->db->link,$data['productname']);
            $brandId= mysqli_real_escape_string($this->db->link,$data['brandId']);
            $categoryId= mysqli_real_escape_string($this->db->link,$data['categoryId']);
            $description= mysqli_real_escape_string($this->db->link,$data['description']);
            $price= mysqli_real_escape_string($this->db->link,$data['price']);
            $type= mysqli_real_escape_string($this->db->link,$data['type']);
            // kiểm tra và lấy hình ảnh vào uploads
            $permited =array('jpg','jpeg','png','gif');
            $file_name=$_FILES['image']['name'];
            $file_size=$_FILES['image']['size'];
            $file_temp=$_FILES['image']['tmp_name'];

            $div=explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10). '.' .$file_ext;
            $uploaded_image= "uploads/".$unique_image;
        
            if($name =="" || $brandId =="" || $categoryId =="" || $description =="" || $price =="" || $type =="" || $file_name ==""){
                $alert ="<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query="INSERT INTO product (productname,brandId,categoryId,description,price,type,image) 
                VALUES ('$name','$brandId','$categoryId','$description','$price','$type','$unique_image')";
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
        public function show_product_all($start,$item_page,$data=[]){
            $where=[];
            if(!empty($data['count']) && $data['count']==true){
                $query="SELECT count(*) as total";
            }else {
                $query= "SELECT product.*, category.catname, brand.brandname"; 
            }

            $query .= " FROM product LEFT JOIN category  ON product.categoryId = category.categoryId
            LEFT JOIN brand  ON product.brandId = brand.brandId";
           
            if(!empty($data['category_id'])){
            $where[] ="category.categoryId=".$data['category_id']; 
            }
            if(!empty($data['keyword'])){
            $where[] ="product.productname LIKE '%".$data['keyword']."%'"; 
            }
            if(!empty($where)){
            $where_string =implode(" AND ",$where);
            $query .= " WHERE ". $where_string ;
            }  
            $query.= " order by product.productId DESC ";
            $list =  [];
            if(!empty($data['count']) && $data['count']==true ){
                $result=$this->db->select($query);
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                return !empty($row) ? $row['total'] : 0;
                
            } else {
                $query.= "LIMIT $start,$item_page ";
                $result=$this->db->select($query);
                if($result){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $list [] = $row;     
                    }
                }else {
                    echo "";
                }
                 
            }
            return $list;
         
        }

        public function search_product($start,$item_page,$data=[]){
            $where='';
            if(!empty($data['count']) && $data['count']==true){
                $query="SELECT count(*) as total";
            }else {
                $query= "SELECT product.*, category.catname, brand.brandname"; 
            }

            $query .= " FROM product INNER JOIN category  ON product.categoryId = category.categoryId
            INNER JOIN brand  ON product.brandId = brand.brandId";
            if(!empty($data['tukhoa'])){
            $where.=" product.productname OR category.catname OR brand.brandname LIKE '%".$data['tukhoa']."%'"; 
            }
            if(!empty($where)){
                $query .= " WHERE ". $where ;
            }  
            $query.= " order by product.productId DESC ";
            $list =  [];
            if(!empty($data['count']) && $data['count']==true ){
                $result=$this->db->select($query);
                $row = $result -> fetch_array(MYSQLI_ASSOC);
                return !empty($row) ? $row['total'] : 0;
                
            } else {
                $query.= "LIMIT $start,$item_page";
                $result=$this->db->select($query);
                if($result){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $list [] = $row;     
                    }
                }else {
                    echo "";
                }
                 
            }
            return $list;
        }
        

        public function update_product($data,$files,$id,$image_old){
            $name= mysqli_real_escape_string($this->db->link,$data['productname']);
            $brandId= mysqli_real_escape_string($this->db->link,$data['brandId']);
            $categoryId= mysqli_real_escape_string($this->db->link,$data['categoryId']);
            $description= mysqli_real_escape_string($this->db->link,$data['description']);
            $price= mysqli_real_escape_string($this->db->link,$data['price']);
            $type= mysqli_real_escape_string($this->db->link,$data['type']);
            $image_old=mysqli_real_escape_string($this->db->link,$image_old);
           
            // kiểm tra và lấy hình ảnh vào uploads
            $permited =array('jpg','jpeg','png','gif');
            $file_name=$_FILES['image']['name'];
            $file_size=$_FILES['image']['size'];
            $file_temp=$_FILES['image']['tmp_name'];

            $div=explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10). '.' .$file_ext;
            $uploaded_image= "../admin/uploads/".$unique_image;
            if($file_name!=''){
                $file_name=$uploaded_image;
            }else {
                $image_old =$uploaded_image;
            }
            if($name =="" || $brandId =="" || $categoryId =="" || $description =="" || $price =="" || $type ==""){
                $alert ="<span class='success'>product must be not empty</span>";
                return $alert;
            }else {
                if(!empty($file_name)){
                    // người dùng chọn hình ảnh
                    if($file_size > 5120000){
                        $alert ="<span class='error'>Image Size should be less then 5MB!</span>";
                        return $alert;
                    }
                    elseif(in_array($file_ext, $permited) ===false){
                        $alert ="<span class='error'>You can only upload:-".implode(',',$permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    unlink("uploads/".$image_old); 
                    $query="UPDATE product SET 
                    productname ='$name',
                    brandId ='$brandId',
                    categoryId ='$categoryId',
                    description ='$description',
                    price ='$price',
                    type ='$type',
                    image ='$unique_image'
                    WHERE productId='$id'";
                }else {
                    // người dùng không chọn hình ảnh
                    $query="UPDATE product SET 
                    productname ='$name',
                    brandId ='$brandId',
                    categoryId ='$categoryId',
                    description ='$description',
                    price ='$price',
                    type ='$type'
                    WHERE productId='$id'";
                }
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

        public function delete_product($productId,$image){
            $query="DELETE FROM product WHERE productId = $productId";
            $result=$this->db->delete($query);
            if($result){
                unlink("uploads/".$image);
                $alert="<span class='success'>Delete Success!</span> ";
                return $alert;
            }else {
                $alert="<span class='success'>Delete not Success!</span> ";
                return $alert;
            }
        }

        public function getproductbyId($id){
            $query="SELECT * FROM product WHERE productId = $id ";
            $result=$this->db->select($query);
            return $result;
        }

        // End backend

        public function getproduct_feathered(){
            $query="SELECT product.*, category.catname, brand.brandname
            FROM product INNER JOIN category  ON product.categoryId = category.categoryId
            INNER JOIN brand  ON product.brandId = brand.brandId
            order by product.productId DESC ";
            $list =  [];
            $result=$this->db->select($query);
                if($result){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                     $list [] = $row;     
                 }
                }else {
                    echo "";
                }
            return $list;
          
        }

        public function getAllproduct(){
            $query="SELECT * FROM product";
            $list =  [];
            $result=$this->db->select($query);
                if($result){
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                     $list [] = $row;     
                 }
                }else {
                    echo "";
                }
           return $list;
        }

        public function getproduct_new(){
            $query="SELECT * FROM product order by productId DESC LIMIT 5";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }
        public function getproduct_all(){
            $query="SELECT * FROM product order by productId DESC ";
            $result=$this->db->select($query);
            return $result;
        }

        public function getDetail ($id){
            $query="SELECT product.*, category.catname, brand.brandname 
            FROM product INNER JOIN category  ON product.categoryId = category.categoryId
            INNER JOIN brand  ON product.brandId = brand.brandId
            WHERE product.productId = '$id' LIMIT 1" ;
            $result=$this->db->select($query);
            return $result;
        }

        public function getLastestAsus(){
            $query="SELECT * FROM product WHERE brandId = '6' order by productId DESC LIMIT 1";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }

        
        public function getLastestSamsung(){
            $query="SELECT * FROM product WHERE brandId = '1' order by productId DESC LIMIT 1";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }

        
        public function getLastestIphone(){
            $query="SELECT * FROM product WHERE brandId = '2' order by productId DESC LIMIT 1";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }

        
        public function getLastestHp(){
            $query="SELECT * FROM product WHERE brandId = '5' order by productId DESC LIMIT 1";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }
        

        // product with category
        public function get_cat_1(){
            $query="SELECT * FROM product WHERE categoryId = '1' order by productId DESC LIMIT 5";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }
        public function get_cat_2(){
            $query="SELECT * FROM product WHERE categoryId = '2' order by productId DESC LIMIT 5";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }
        public function get_cat_3(){
            $query="SELECT * FROM product WHERE categoryId = '3' order by productId DESC LIMIT 5";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }
        public function get_cat_4(){
            $query="SELECT * FROM product WHERE categoryId = '4' order by productId DESC LIMIT 5";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }

        // product wishlist
        public function insertWishlist($productid, $customerId){
            $productid= mysqli_real_escape_string($this->db->link, $productid);
            $customerId= mysqli_real_escape_string($this->db->link, $customerId);

            $check_wish ="SELECT * FROM wishlist WHERE productId ='$productid' AND customerId ='$customerId'";
            $result_check_wish=$this->db->select($check_wish);

            if($result_check_wish){
                $message='<span class="success">Product Already Added to wishlist!</span>';
                return $message;
            }else {
                $query="SELECT * FROM product WHERE productId = '$productid' ";
                $result=$this->db->select($query)->fetch_assoc();

                $productname=$result['productname'];
                $price = $result['price'];
                $image=$result['image'];

                $query_insert="INSERT INTO wishlist (productId, price, image, customerId, productname) 
                VALUES ('$productid','$price','$image','$customerId',' $productname')";
                $insert_wish=$this->db->insert($query_insert);
                if($insert_wish){
                    $alert="<span class='success'>Added to Wishlist Success!</span> ";
                    return $alert;
                }else {
                    $alert="<span class='error'>Added to Wishlist not Success!</span> ";
                    return $alert;
                }
            }
        }
        public function get_wish_list($customerId){
            $query="SELECT * FROM wishlist WHERE customerId = '$customerId' order by wishId DESC ";
            $result=$this->db->select($query);
            return $result;
        }

        public function del_wish($productId,$customerId){
            $query="DELETE FROM wishlist WHERE productId = '$productId' AND customerId = '$customerId'";
            $result=$this->db->delete($query);
            return $result;
        }


        // slider
        public function insert_slider($data, $files){
            $slidername= mysqli_real_escape_string($this->db->link,$data['slidername']);
            $type= mysqli_real_escape_string($this->db->link,$data['type']);
            // kiểm tra và lấy hình ảnh vào uploads
            $permited =array('jpg','jpeg','png','gif');
            $file_name=$_FILES['image']['name'];
            $file_size=$_FILES['image']['size'];
            $file_temp=$_FILES['image']['tmp_name'];

            $div=explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()),0, 10). '.' .$file_ext;
            $uploaded_image= "../admin/uploads/".$unique_image;
        
            if($slidername =="" || $type ==""){
                $alert ="<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query="INSERT INTO slider (slidername,type,sliderimage) 
                VALUES ('$slidername','$type','$unique_image')";
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

        public function show_slider(){
            $query="SELECT * FROM slider WHERE type ='1' order by sliderId DESC ";
            $list =  [];
            $result=$this->db->select($query);
            if($result){
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                    $list [] = $row;     
                }
            }else {
                echo "";
            }
            return $list;
        }

        public function del_slider($sliderId,$slider_image){
            $query="DELETE FROM slider WHERE sliderId = $sliderId";
            $result=$this->db->delete($query);
            if($result){
                unlink("uploads/".$slider_image);
                $alert="<span class='success'>Delete Success!</span> ";
                return $alert;
            }else {
                $alert="<span class='success'>Delete not Success!</span> ";
                return $alert;
            }
            
        }
        
    }   
?>