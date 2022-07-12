<?php
require_once 'Database.php';


class Posts extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddPost($data, $file){

        $post_title = mysqli_escape_string($this->db->link, $data['post_title']);

        $post_body   = mysqli_escape_string($this->db->link, $data['post_body']);
        $post_tags   = mysqli_escape_string($this->db->link, $data['post_tags']);
        $read_time   = mysqli_escape_string($this->db->link, $data['read_time']);
        $post_category   = mysqli_escape_string($this->db->link, $data['post_category']);
        $post_author = "Admin";
        $post_count= "0";
        date_default_timezone_set("Africa/Lagos");
        $post_date = date("M d, Y") . ' at ' . date("h:i A");
        $permitted  = array('jpg','jpeg','png','gif');
        $file_name = $file['post_img']['name'];
        $file_size = $file['post_img']['size'];
        $file_temp = $file['post_img']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_image= "blog_image/".$unique_image;

        if ($post_title== "" || $post_body == "" || $read_time=="" || $post_category=="") {
            Flash("error",  "Fill in the Empty field");
        }elseif ($file_size > 7048567) {
            Flash("error",  "choose a smaller size image less than 7mb");
        }elseif(in_array($file_ext, $permitted)=== false){
            Flash("error",  "Choose file extension png, jpg");
        }else{
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO post_tbl(post_title, post_content, post_category, post_image, post_author, post_count, post_tags, read_time, post_date) VALUES('$post_title','$post_body', '$post_category', '$uploaded_image','$post_author','$post_count', '$post_tags','$read_time', '$post_date')";

            $insertPost= $this->db->insert($query);

        if ($insertPost){
            Flash("success",  "Post has been successfully added");
        } else {
            Flash("error",  "Post is not added");
        }


        }

    }


// Fetch all Posts

    public function getAllPosts($table_name,  $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Fetch all Posts for Main website

    public function getAllPostsBlog($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id ";
        $result= $this->db->select($query);
        return $result;
       
    }

    public function getAllPostHome($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    public function getAllPostCategoryHome($cat_id, $offset, $record_per_page){
        $query = "SELECT * FROM post_tbl WHERE post_category = '$cat_id' ORDER BY post_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    public function getAllPostSearchHome($search, $offset, $record_per_page){
        $query = "SELECT * FROM post_tbl WHERE post_title LIKE '%$search%' ORDER BY post_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Posts
public function delPostById($id){

    $query = "SELECT * FROM post_tbl WHERE post_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delimg= $getData->fetch_assoc()) {
                $delink= $delimg['post_image'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM post_tbl WHERE post_id = '$id'";

        $testDelete= $this->db->delete($delquery);

                if ($testDelete){
                    echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-posts';
                    }, 3000);
                 </script>";
                Flash("success",  "Post Successfully deleted");
                } else {
                    Flash("error",  "Post not deleted");
                }
    }

// Get Post by ID

public function getPostById($id){
    $query = "SELECT * FROM post_tbl WHERE post_id = '$id'";

    $result = $this->db->select($query);

    return $result;
}

// Update Post	

public function UpdatePost($data, $file, $id){
    $post_title = mysqli_escape_string($this->db->link, $data['post_title']);

    $post_body   = mysqli_escape_string($this->db->link, $data['post_body']);
    $post_tags   = mysqli_escape_string($this->db->link, $data['post_tags']);
    $read_time   = mysqli_escape_string($this->db->link, $data['read_time']);
    $post_category   = mysqli_escape_string($this->db->link, $data['post_category']);
    $post_author = "Admin";
    // $post_count= "0";
    date_default_timezone_set("Africa/Lagos");
    $post_date = date("M d, Y") . ' at ' . date("h:i A");
    $permitted  = array('jpg','jpeg','png','gif');
    $file_name = $file['post_img']['name'];
    $file_size = $file['post_img']['size'];
    $file_temp = $file['post_img']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

    $uploaded_image= "blog_image/".$unique_image;

    if ($post_title== "" || $post_body == "" || $read_time=="" || $post_category=="") {
        // $msg = "<span class='alert alert-danger'>fields must not be empty</span>";
        Flash("error",  "Fill the empty field");

    }else{ 

        if (!empty($file_name)) {

            if ($file_size > 7048567) {
            
                Flash("error",  "select image that is less than 7mb");

            }elseif(in_array($file_ext, $permitted)=== false){
                
                Flash("error",  "choose file extension .png, .jpg");

            }else{
                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE post_tbl SET  
                post_title = '$post_title',
                post_content = '$post_body',
                post_category = '$post_category',
                post_image = '$uploaded_image',
                post_author = '$post_author',
                post_tags = '$post_tags',
                read_time = '$read_time'

                WHERE post_id = '$id' ";

                $postUpdate= $this->db->update($query);

            if ($postUpdate){
                echo "<script>
                setTimeout(function(){
                   window.location.href = 'all-posts';
                }, 3000);
             </script>";
            Flash("success",  "Post Successfully updated");
            } else {
                Flash("error",  "Post is not updated");
            }


            } 

        }else {

            $query = "UPDATE post_tbl SET  
            post_title = '$post_title',
            post_content = '$post_body',
            post_category = '$post_category',
            -- post_image = '$uploaded_image',
            post_author = '$post_author',
            post_tags = '$post_tags',
            read_time = '$read_time'

            WHERE post_id = '$id' ";

                $post_Update= $this->db->update($query);

            if ($post_Update){
                echo "<script>
                setTimeout(function(){
                   window.location.href = 'all-posts';
                }, 3000);
             </script>";
            Flash("success",  "Post Successfully updated");
            } else {
                Flash("error",  "Post is not updated");
            }
        }

  }
}



}

?>

