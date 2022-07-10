<?php
require_once 'Database.php';
require_once "flashMessage.php";


class Category extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


    public function InsertCategory($cat_name){

        $cat_name = mysqli_escape_string($this->db->link,$cat_name);

        if ($cat_name=="" ) {
           Flash("error", "fill in the field");

        }else{
            $query = "INSERT INTO category_tbl(cat_name) VALUES('$cat_name')";
            $InsertCat= $this->db->insert($query);

            if ($InsertCat){
                Flash("success",  "Category Successfully added");
               
            } else {
                $msg = "<span class='alert alert-danger'>Category not added</span>";

                return $msg;
            }
            
        }


    }

// Fetch all category

    public function getCategory($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id";
        $result= $this->db->select($query);
        return $result;
       
    }

    

// Delete Category

    public function delCategoryById($id){

    $query = "DELETE FROM category_tbl WHERE cat_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        
        echo "<script>
            setTimeout(function(){
               window.location.href = 'all-category';
            }, 3000);
         </script>";
        Flash("success",  "Category Successfully deleted");

        } else {
            Flash("error",  "Category not deleted");
        }
}


// Get Category by ID

public function getCategoryById($id){

    $query = "SELECT * FROM category_tbl WHERE cat_id = '$id'";

    $result = $this->db->select($query);

    return $result;

}

// Update Category

public function UpdateCat($cat_name, $id){

    $cat_name = mysqli_escape_string($this->db->link,$cat_name);
    $id = mysqli_escape_string($this->db->link,$id);

    if ($cat_name=="") {
        Flash("error",  "Fill in the empty field");
    }else {
        $query = "UPDATE category_tbl SET cat_name = '$cat_name'  WHERE cat_id = '$id'";

        $updated_row = $this->db->update($query);
        if ($updated_row) {
           
            echo "<script>
            setTimeout(function(){
               window.location.href = 'all-category';
            }, 3000);
         </script>";
           
            Flash("success",  "Category Successfully Updated");
            // header("Location: all-category.php");
        } else {
            Flash("error",  "Category not updated");
        }
        
    }

}

}

?>

