<?php
require_once 'Database.php';


class Award extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddAward($data, $file){

      
        $award_title   = mysqli_escape_string($this->db->link, $data['award_title']);
        $award_org   = mysqli_escape_string($this->db->link, $data['organization']);
        
        date_default_timezone_set("Africa/Lagos");
        $award_date = date("M d, Y") . ' at ' . date("h:i A");
        $permitted  = array('jpg','png','jpeg');
        $file_name = $file['award_image']['name'];
        $file_size = $file['award_image']['size'];
        $file_temp = $file['award_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_img= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_img= "award/".$unique_img;

        if ($award_title== "" || $award_org=="" ) {
            Flash("error",  "Fill in the space");
        
        }elseif(in_array($file_ext, $permitted)=== false){
            Flash("error",  "you are allowed to upload jpg, png, jpeg file");
        }else{
            move_uploaded_file($file_temp, $uploaded_img);

            $query = "INSERT INTO award_tbl(award_title, award_org, award_image, award_date) VALUES('$award_title', '$award_org', '$uploaded_img', '$award_date')";

            $insertAward= $this->db->insert($query);

        if ($insertAward){
            Flash("success",  "Award has been successfully added");
        } else {
            Flash("error",  "Award is not added");
        }


        }

    }


// Fetch all Testimony

    public function getAward($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id ";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Team Testimonial
public function delAwardById($id){

    $query = "SELECT * FROM award_tbl WHERE award_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delaward= $getData->fetch_assoc()) {
                $delink= $delaward['award_image'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM award_tbl WHERE award_id = '$id'";

        $AwardDelete= $this->db->delete($delquery);

                if ($AwardDelete){
                    echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-awards';
                    }, 3000);
                 </script>";
                Flash("success",  "Award Successfully deleted");
                } else {
                    Flash("error",  "Award is not deleted");
                }
    }



    
public function UpdateAward($data, $file, $id){
    $award_title = mysqli_escape_string($this->db->link, $data['award_title']);
    $award_org 	 = mysqli_escape_string($this->db->link, $data['organization']);
    
    $permitted  = array('jpg','jpeg','png','gif');
    $file_name = $file['award_image']['name'];
    $file_size = $file['award_image']['size'];
    $file_temp = $file['award_image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

    $uploaded_image= "award/".$unique_image;

    if ($award_title== ""  || $award_org =="") {
        Flash("error",  "Fill in the empty space");

    }else{ 

        if (!empty($file_name)) {

            if ($file_size > 7048567) {
            
                Flash("error",  "Upload size must not be more than 7mb");

            }elseif(in_array($file_ext, $permitted)=== false){
                
                Flash("error",  "Allowed file is jpg, jpeg, png");

            }else{
                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE award_tbl SET  
                award_title = '$award_title',
               
                award_org = '$award_org',
                award_image = '$uploaded_image'

                WHERE award_id = '$id' ";

                $awardUpdate= $this->db->update($query);

            if ($awardUpdate){
                echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-awards';
                    }, 3000);
                 </script>";
                Flash("success",  "Award Successfully Updated");
                } else {
                    Flash("error",  "Award is not Updated");
                }

            } 

        }else {

            $query = "UPDATE award_tbl SET  
               award_title = '$award_title',
               
               award_org = '$award_org'
                -- test_image = '$uploaded_image'

                WHERE award_id = '$id' ";

                $award_Update= $this->db->update($query);

            if ($award_Update){
                echo "<script>
                setTimeout(function(){
                   window.location.href = 'all-awards';
                }, 3000);
             </script>";
            Flash("success",  "Award Successfully updated");
            } else {
                Flash("error",  "Award is not updated");
            }
        }

  }
}

}

?>

