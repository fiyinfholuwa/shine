<?php
require_once 'Database.php';


class ProductCategory extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


    public function InsertProCategory($cat_name){

        $cat_name = mysqli_escape_string($this->db->link,$cat_name);

        if ($cat_name=="" ) {
            $msg = "<span class='alert alert-danger '> fields must not be empty</span>";
            return $msg;
        }else{
            $query = "INSERT INTO pro_category_tbl(cat_name) VALUES('$cat_name')";
            $InsertCat= $this->db->insert($query);

            if ($InsertCat){
                $msg= "<span class='alert alert-success'>Department successfully added.</span>";

                return $msg;
            } else {
                $msg = "<span class=' alert alert-danger'>Department not added</span>";

                return $msg;
            }
            
        }


    }

// Fetch all category

    public function getProCategory($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Category

    public function delProCategoryById($id){

    $query = "DELETE FROM pro_category_tbl WHERE cat_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        
        echo "<script>window.location = 'all_department'</script>";

        } else {
            echo "<script>alert('Department not deleted ')</script>";
        }
}


// Get Category by ID

public function getProCategoryById($id){

    $query = "SELECT * FROM pro_category_tbl WHERE cat_id = '$id'";

    $result = $this->db->select($query);

    return $result;

}

// Update Category

public function UpdateProCat($cat_name, $id){

    $cat_name = mysqli_escape_string($this->db->link,$cat_name);
    $id = mysqli_escape_string($this->db->link,$id);

    if ($cat_name=="") {
        $msg = "<span class='alert alert-danger'>fields must not be empty</span>";

        return $msg;
    }else {
        $query = "UPDATE pro_category_tbl SET cat_name = '$cat_name'  WHERE cat_id = '$id'";

        $updated_row = $this->db->update($query);
        if ($updated_row) {
            echo "<script>alert('Department updated sucessfully')</script>";
            echo "<script>window.location = 'all_department'</script>";
        } else {
            $msg = "<span class=' alert alert-danger'>Department not updated</span>";

            return $msg;
        }
        
    }

}

}

?>

