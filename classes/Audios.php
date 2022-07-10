<?php
require_once 'Database.php';


class Audio extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddAudio($data, $file){

      
        $audio_title   = mysqli_escape_string($this->db->link, $data['audio_title']);

        $permitted  = array('mp4','mp3');
        $file_name = $file['audio_file']['name'];
        $file_size = $file['audio_file']['size'];
        $file_temp = $file['audio_file']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_audio= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_audio= "audios/".$unique_audio;

        if ($audio_title== "" ) {
            Flash("error",  "Fill in the space");
        
        }elseif(in_array($file_ext, $permitted)=== false){
            Flash("error",  "you are allowed to upload mp3 and mp4 file");
        }else{
            move_uploaded_file($file_temp, $uploaded_audio);

            $query = "INSERT INTO audio_tbl(audio_title, uploaded_audio) VALUES('$audio_title', '$uploaded_audio')";

            $insertAudio= $this->db->insert($query);

        if ($insertAudio){
            Flash("success",  "Audio has been successfully added");
        } else {
            Flash("error",  "Audio is not added");
        }


        }

    }


// Fetch all Testimony

    public function getAllAudio($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id ";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Team Testimonial
public function delAudioById($id){

    $query = "SELECT * FROM audio_tbl WHERE audio_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delaudio= $getData->fetch_assoc()) {
                $delink= $delaudio['uploaded_audio'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM audio_tbl WHERE audio_id = '$id'";

        $AudioDelete= $this->db->delete($delquery);

                if ($AudioDelete){
                    echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-audios';
                    }, 3000);
                 </script>";
                Flash("success",  "Audio Successfully deleted");
                } else {
                    Flash("error",  "Audio is not deleted");
                }
    }

}

?>

