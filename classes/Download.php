<?php
require_once 'Database.php';


class Download extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddPdf($data, $file){

      
        $pdf_title   = mysqli_escape_string($this->db->link, $data['pdf_title']);

        $permitted  = array('pdf', 'doc', 'docx');
        $file_name = $file['pdf_file']['name'];
        $file_size = $file['pdf_file']['size'];
        $file_temp = $file['pdf_file']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_pdf= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_pdf= "PDF/".$unique_pdf;

        if ($pdf_title== "" ) {
            Flash("error",  "Fill in the space");
        
        }elseif(in_array($file_ext, $permitted)=== false){
            Flash("error",  "you are allowed to upload pdf, doc file");
        }else{
            move_uploaded_file($file_temp, $uploaded_pdf);

            $query = "INSERT INTO pdf_tbl(pdf_title, uploaded_pdf) VALUES('$pdf_title', '$uploaded_pdf')";

            $insertPdf= $this->db->insert($query);

        if ($insertPdf){
            Flash("success",  "Pdf has been successfully added");
        } else {
            Flash("error",  "Pdf is not added");
        }


        }

    }


// Fetch all Testimony

    public function getPdf($table_name, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id ";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Team Testimonial
public function delPdfById($id){

    $query = "SELECT * FROM pdf_tbl WHERE pdf_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delPdf= $getData->fetch_assoc()) {
                $delink= $delPdf['uploaded_pdf'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM pdf_tbl WHERE pdf_id = '$id'";

        $PdfDelete= $this->db->delete($delquery);

                if ($PdfDelete){
                    echo "<script>
                    setTimeout(function(){
                       window.location.href = 'all-pdfs';
                    }, 3000);
                 </script>";
                Flash("success",  "Pdf Successfully deleted");
                } else {
                    Flash("error",  "Pdf is not deleted");
                }
    }

}

?>

