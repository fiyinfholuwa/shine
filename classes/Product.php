<?php
require_once 'Database.php';


class Product extends Database{
    private $db;

     

     public function __construct(){
             $this->db = new Database();
            
        }

    // Add category


     public function AddProduct($data, $file){

        $product_title = mysqli_escape_string($this->db->link, $data['product_title']);

        $product_brief   = mysqli_escape_string($this->db->link, $data['product_brief']);
        $product_price   = mysqli_escape_string($this->db->link, $data['product_price']);
        $product_category   = mysqli_escape_string($this->db->link, $data['product_category']);
        $product_author = "Research Centa";
        $author_email = "admin@researchcenta.com";
        $product_number = rand(1000, 9999);
        $product_tag = "PRC00";
        $product_serial = $product_tag . $product_number;
        $status = "active";
        
        

        $permitted  = array('pdf','doc','docx','xls');
       

        
        $file_namee = $file['complete_product']['name'];
        $file_sizee = $file['complete_product']['size'];
        $file_tempp = $file['complete_product']['tmp_name'];

        $divv = explode('.', $file_namee);
        $file_extt = strtolower(end($divv));
        $unique_filee= substr(md5(time()), 0,10 ). '.' .$file_extt;

        $filee= "complete_files/".$unique_filee;

        if ($product_title== "" || $product_brief == "" || $product_price=="" || $product_category=="") {
            $msg = "<span class='alert alert-danger'>fields must not be empty</span>";

        return $msg;
        }elseif ($file_sizee > 7048567  ) {
            echo "<span class='alert alert-danger'>File allowed should be less than 7Mb.</span>";
        }elseif(in_array($file_extt, $permitted)=== false){
            echo "<span class='alert alert-danger'>You can only upload :-".implode(',', $permitted)."</span>";
        }else{
          
            move_uploaded_file($file_tempp, $filee);

            $query = "INSERT INTO product_tbl(product_title, product_brief, product_price, product_category,  product_author, product_serial, complete_fname, complete_name, status, author_email) VALUES('$product_title','$product_brief', '$product_price', '$product_category',  '$product_author', '$product_serial', '$unique_filee', '$file_namee', '$status', 
            '$author_email' )";

            $inserttest= $this->db->insert($query);

        if ($inserttest){
            $msg= "<span class='alert alert-success'>Project successfully added.</span>";

            return $msg;
        } else {
            $msg = "<span class='alert alert-danger'>Project not inserted</span>";

            return $msg;
        }


        }

    }


// Fetch all product

    public function getAllProduct($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete product
public function delProductById($id){

    $query = "SELECT * FROM product_tbl WHERE product_id = '$id'";

        $getData = $this->db->select($query);
        if ($getData) {
            while ($delimg= $getData->fetch_assoc()) {
                $delink= $delimg['fname'];

                unlink($delink);
            }
        }

        $delquery = "DELETE FROM product_tbl WHERE product_id = '$id'";

        $testDelete= $this->db->delete($delquery);

                if ($testDelete){
                    echo "<script>alert('Product  deleted')</script>";
                    echo "<script>window.location = 'all_project'</script>";
                } else {
                    
                    echo "<script>alert('Testimonial not deleted')</script>";
                    
                }
    }

    public function getProductById($id){

        $query = "SELECT * FROM product_tbl WHERE product_id = '$id'";
    
        $result = $this->db->select($query);
    
        return $result;
    
    }

    public function UpdateProjectStatus($data, $id){

        $status = mysqli_escape_string($this->db->link, $data['status']);
        $product_title = mysqli_escape_string($this->db->link, $data['product_title']);
        $product_brief = mysqli_escape_string($this->db->link, $data['product_brief']);
        $product_price = mysqli_escape_string($this->db->link, $data['product_price']);
        $product_category = mysqli_escape_string($this->db->link, $data['product_category']);
        $author_email = mysqli_escape_string($this->db->link, $data['email']);
        $id = mysqli_escape_string($this->db->link,$id);
    
        if ($status=="") {
            $msg = "<span class='alert alert-danger'>fields must not be empty</span>";
    
            return $msg;
        }else {
            $query = "UPDATE product_tbl SET product_title = '$product_title', product_brief = '$product_brief', product_price = '$product_price', product_category = '$product_category', status = '$status'  WHERE product_id = '$id'";
    
            $updated_row = $this->db->update($query);
            if ($updated_row) {

                $to = $author_email;
              $subject = "Product status alert";
              $message = "
                <html>
                <head>
                <title>status alert</title>
                </head>
                <body>
                <h2>Admin has approed you recently uploaded product.</h2>
                
                <h4><a href='https://researchcenta.com/centa/uploaderlogin'>Click here</h4>
                </body>
                </html>
                ";
              //dont forget to include content-type on header if your sending html
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= "From: admin@researchcenta.com". "\r\n" .
                    "CC: admin@researchcenta.com";

          mail($to,$subject,$message,$headers);
                echo "<script>alert('Project status sucessfully updated')</script>";
                echo "<script>window.location = 'all_project'</script>";
            } else {
                $msg = "<span class=' alert alert-danger'>Project not updated</span>";
    
                return $msg;
            }
            
        }
    
    }
    
}

?>

