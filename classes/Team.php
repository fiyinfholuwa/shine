<?php
require_once 'Database.php';


class Team extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddTeam($data, $file){

        $full_name = mysqli_escape_string($this->db->link, $data['full_name']);

       
        $role   = mysqli_escape_string($this->db->link, $data['role']);

        $permitted  = array('jpg','jpeg','png','gif');
        $file_name = $file['team_image']['name'];
        $file_size = $file['team_image']['size'];
        $file_temp = $file['team_image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_image= "team/".$unique_image;

        if ($full_name== "" || $role=="") {
            Flash("error",  "Fill in the empty space");
        }elseif ($file_size > 7048567) {
            Flash("error",  "Allowed size is 7mb");
        }elseif(in_array($file_ext, $permitted)=== false){
            Flash("error",  "Allowed extension is jpg, jpeg, jpg");
        }else{
            move_uploaded_file($file_temp, $uploaded_image);

            $query = "INSERT INTO team_tbl(full_name,  role, team_image) VALUES('$full_name','$role', '$uploaded_image')";

            $inserttest= $this->db->insert($query);

        if ($inserttest){
            
        Flash("success",  "Team Successfully added");
        } else {
            Flash("error",  "Team is not added");
        }


        }

    }


// Fetch all Testimony

    public function getAllTeam($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id";
        $result= $this->db->select($query);
        return $result;
       
    }


    public function getAllTeamHome($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Team Testimonial
public function delTeamById($id){

    $query = "SELECT * FROM team_tbl WHERE team_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delimg= $getData->fetch_assoc()) {
                $delink= $delimg['team_image'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM team_tbl WHERE team_id = '$id'";

        $teamDelete= $this->db->delete($delquery);

                if ($teamDelete){
                    echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-team';
                    }, 3000);
                 </script>";
                Flash("success",  "Team Successfully deleted");
                } else {
                    Flash("error",  "Team is not deleted");
                }
    }
// get testimonial by id

public function getTeamById($id){
    $query = "SELECT * FROM team_tbl WHERE team_id = '$id'";

    $result = $this->db->select($query);

    return $result;
}

// Update testimonial	

public function UpdateTeam($data, $file, $id){
    $full_name = mysqli_escape_string($this->db->link, $data['full_name']);
    $role 	 = mysqli_escape_string($this->db->link, $data['role']);
    
    $permitted  = array('jpg','jpeg','png','gif');
    $file_name = $file['team_image']['name'];
    $file_size = $file['team_image']['size'];
    $file_temp = $file['team_image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image= substr(md5(time()), 0,10 ). '.' .$file_ext;

    $uploaded_image= "team/".$unique_image;

    if ($full_name== ""  || $role =="") {
        Flash("error",  "Fill in the empty space");

    }else{ 

        if (!empty($file_name)) {

            if ($file_size > 7048567) {
            
                Flash("error",  "Upload size must not be more than 7mb");

            }elseif(in_array($file_ext, $permitted)=== false){
                
                Flash("error",  "Allowed file is jpg, jpeg, png");

            }else{
                move_uploaded_file($file_temp, $uploaded_image);

                $query = "UPDATE team_tbl SET  
                full_name = '$full_name',
               
                role = '$role',
                team_image = '$uploaded_image'

                WHERE team_id = '$id' ";

                $teamUpdate= $this->db->update($query);

            if ($teamUpdate){
                echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-team';
                    }, 3000);
                 </script>";
                Flash("success",  "Team Successfully Updated");
                } else {
                    Flash("error",  "Team is not Updated");
                }

            } 

        }else {

            $query = "UPDATE team_tbl SET  
                full_name = '$full_name',
               
                role = '$role'
                -- test_image = '$uploaded_image'

                WHERE team_id = '$id' ";

                $team_Update= $this->db->update($query);

            if ($team_Update){
                echo "<script>
                setTimeout(function(){
                   window.location.href = 'all-team';
                }, 3000);
             </script>";
            Flash("success",  "Team Successfully updated");
            } else {
                Flash("error",  "Team is not updated");
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

