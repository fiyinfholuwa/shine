<?php
require_once 'Database.php';


class Testimony extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddTestimony($data, $file){

        $full_name = mysqli_escape_string($this->db->link, $data['full_name']);

        $content   = mysqli_escape_string($this->db->link, $data['content']);
        $role   = mysqli_escape_string($this->db->link, $data['role']);

        $permitted  = array('jpg','jpeg','png','gif');
        $file_name = $file['test_image']['name'];
        $file_size = $file['test_image']['size'];
        $file_temp = $file['test_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_image= "testimonial/".$unique_image;

        if ($full_name== "" || $content == "" || $file_name=="" || $role=="") {
            Flash("error",  "Fill in the empty space");
        }elseif ($file_size > 7048567) {
            Flash("error",  "Allowed size is 7mb");
        }elseif(in_array($file_ext, $permitted)=== false){
            Flash("error",  "Allowed extension is jpg, jpeg, jpg");
        }else{
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO testimony_tbl(full_name, content, role, test_image) VALUES('$full_name','$content', '$role', '$uploaded_image')";

            $inserttest= $this->db->insert($query);

        if ($inserttest){
            
        Flash("success",  "Testimonial Successfully added");
        } else {
            Flash("error",  "Testimonial is not added");
        }


        }

    }


// Fetch all Testimony

    public function getAllTestimony($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Team Testimonial
public function delTestimonyById($id){

    $query = "SELECT * FROM testimony_tbl WHERE test_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delimg= $getData->fetch_assoc()) {
                $delink= $delimg['test_image'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM testimony_tbl WHERE test_id = '$id'";

        $testDelete= $this->db->delete($delquery);

                if ($testDelete){
                    echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-testimonial';
                    }, 3000);
                 </script>";
                Flash("success",  "Testimony Successfully deleted");
                } else {
                    Flash("error",  "Testimony is not deleted");
                }
    }
// get testimonial by id

public function getTestimonialById($id){
    $query = "SELECT * FROM testimony_tbl WHERE test_id = '$id'";

    $result = $this->db->select($query);

    return $result;
}

// Update testimonial	

public function UpdateTestimony($data, $file, $id){
    $full_name = mysqli_escape_string($this->db->link, $data['full_name']);

    $content 	 = mysqli_escape_string($this->db->link, $data['content']);
    $role 	 = mysqli_escape_string($this->db->link, $data['role']);
    
    $permitted  = array('jpg','jpeg','png','gif');
    $file_name = $file['test_image']['name'];
    $file_size = $file['test_image']['size'];
    $file_temp = $file['test_image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

    $uploaded_image= "testimonial/".$unique_image;

    if ($full_name== "" || $content == "" || $role =="") {
        // $msg = "<span class='alert alert-danger'>fields must not be empty</span>";
        Flash("error",  "Fill in the empty field");

    }else{ 

        if (!empty($file_name)) {

            if ($file_size > 7048567) {
            
                Flash("error",  "Upload file must not exceed 7mb");

            }elseif(in_array($file_ext, $permitted)=== false){
                
                Flash("error",  "Allowed extension is jpg, png, jpeg");

            }else{
                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE testimony_tbl SET  
                full_name = '$full_name',
                content = '$content',
                role = '$role',
                test_image = '$uploaded_image'

                WHERE test_id = '$id' ";

                $testUpdate= $this->db->update($query);

            if ($testUpdate){
                echo "<script>
                setTimeout(function(){
                   window.location.href = 'all-testimonial';
                }, 3000);
             </script>";
            Flash("success",  "Testimony Successfully updated");
            } else {
                Flash("error",  "Testimony is not updated");
            }


            } 

        }else {

            $query = "UPDATE testimony_tbl SET  
                full_name = '$full_name',
                content = '$content',
                role = '$role'
                -- test_image = '$uploaded_image'

                WHERE test_id = '$id' ";

                $team_Update= $this->db->update($query);

            if ($team_Update){
                echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-testimonial';
                    }, 3000);
                 </script>";
                Flash("success",  "Testimony Successfully updated");
                } else {
                    Flash("error",  "Testimony is not updated");
                }
        }

  }
}

// Testimony home page

public function getTestimonyHome(){
    $query = "select * from testimony_tbl order by test_id";
    $result = $this->db->select($query);

    return $result;

}

}

?>

