<?php
require_once 'Database.php';
require_once 'Session.php';


class Uploaders extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

//    Insert Uploader

public function InsertUploader($data){
        $first_name 	 = mysqli_escape_string($this->db->link, $data['first_name']);
		$last_name = mysqli_escape_string($this->db->link, $data['last_name']);
		$tel   = mysqli_escape_string($this->db->link, $data['tel']);
		$email   = mysqli_escape_string($this->db->link, $data['email']);
        $password 	 = mysqli_escape_string($this->db->link, md5($data['password']));
        $conf_password = mysqli_escape_string($this->db->link, md5($data['conf_password']));
       $verify_token = rand(10, 100000);
        $verify_email = 0;
        $acct_name = "";
        $acct_num ="";
        $bank_name="";
        if ($first_name=="") {
        $msg = "<h6 style='color:red;' class='alert alert-danger'>first name is missing.</h6>";
        return $msg;
    }elseif ($last_name=="") {
        $msg = "<h6 style='color:red;' class='alert alert-danger'>last name is missing.</h6>";
        return $msg;
    }elseif ($tel=="") {
        $msg = "<h6 style='color:red;' class='alert alert-danger'>Input your Phone number</h6>";
        return $msg;
    }elseif ($email=="") {
        $msg = "<h6 style='color:red;' class='alert alert-danger'>input your valid email.</h6>";
        return $msg;
    }elseif ($password!=$conf_password) {
        $msg = "<h6 style='color:red;' class='alert alert-danger'>Password doesnot match</h6>";
        return $msg;
    }else{
        
        $mailquery = "SELECT * FROM uploader_tbl WHERE email = '$email' LIMIT 1 ";

		$mailchk = $this->db->select($mailquery);

		if ($mailchk !=false) {
			echo"<script>alert('Email already registered')</script>";
		}else{
			$query = "INSERT INTO uploader_tbl(first_name, last_name, tel,  email, password, conf_password, verify_token, verify_email, acct_name, acct_num, bank_name) VALUES('$first_name','$last_name', '$tel','$email', '$password', '$conf_password', '$verify_token', '$verify_email', '$acct_name', '$acct_num', '$bank_name')";

			$uploaderInsert= $this->db->insert($query);

		if ($uploaderInsert){
			// echo"<script>alert('You can check your email for verification')</script>";
            $to = $email;
            $subject = "Sign Up Verification Code";
            $message = "
                <html>
                <head>
                <title>Verification Code</title>
                </head>
                <body>
                <h2>Thank you for Registering.</h2>
                <p>Your Account:</p>
                <p>Email: ".$email."</p>
                <p>Password: ".$_POST['password']."</p>
                <p>Please click the link below to activate your account.</p>
                <h4><a href='https://researchcenta.com/uploaderactivate?uid=$email&code=$verify_token'>Activate My Account</h4>
                </body>
                </html>
                ";
            //dont forget to include content-type on header if your sending html
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From: admin@researchcenta.com". "\r\n" .
                        "CC: admin@researchcenta.com";

        mail($to,$subject,$message,$headers);

        echo"<script>alert('You can check your email for verification')</script>";
		} else {
			echo"<script>alert('error, data not inserted')</script>";
		}
        
    }
        }

        }

        public function UploaderLogin($data){
			$email 	 = mysqli_escape_string($this->db->link, $data['email']);
			$password = mysqli_escape_string($this->db->link, md5($data['password']));

			if (empty($email) || empty($password)) {
				$msg = "<span style='color:red;' class=' alert alert-danger'>Fill in the blank space</span>";

                return $msg;
			}else{

			$query = "SELECT * FROM uploader_tbl WHERE email ='$email' AND password = '$password' ";

			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();

				Session::set("uploaderLog", true);
				Session::set ("uploaderId", $value['upload_id']);
				Session::set ("email", $value['email']);

				echo "<script>window.location = 'uploader/dashboard'</script>";

			}else{
				$msg = "<span style='color:red;' class=' alert alert-danger'>Email or Password doesnot match</span>";

                return $msg;
            }
        }

        }
        
        public function getUploaderData($id){
			$query = "SELECT * FROM uploader_tbl WHERE upload_id = '$id' ";
		$result = $this->db->select($query);

		return $result;
		}


		// Update profile


		public function UpdateProfile($data, $id){
				$first_name 	 = mysqli_escape_string($this->db->link, $data['first_name']);
				$last_name = mysqli_escape_string($this->db->link, $data['last_name']);
				$tel   = mysqli_escape_string($this->db->link, $data['tel']);
				$email   = mysqli_escape_string($this->db->link, $data['email']);
                $acct_name   = mysqli_escape_string($this->db->link, $data['acct_name']);
                $acct_num   = mysqli_escape_string($this->db->link, $data['acct_num']);
                $bank_name   = mysqli_escape_string($this->db->link, $data['bank_name']);
			$id = mysqli_escape_string($this->db->link,$id);
		
			if ($first_name=="" || $last_name=="" || $tel=="" || $email=="" || $acct_num=="" || $acct_name=="" || $bank_name=="") {
				$msg = "<span class='alert alert-danger'>fields must not be empty</span>";
		
				return $msg;
			}else {
				$query = "UPDATE uploader_tbl SET first_name = '$first_name', last_name= '$last_name', tel = '$tel', email = '$email', acct_name ='$acct_name', acct_num='$acct_num', bank_name='$bank_name'  WHERE upload_id = '$id'";
		
				$updated_row = $this->db->update($query);
				if ($updated_row) {
					echo "<script>alert('profile updated sucessfully')</script>";
					echo "<script>window.location = 'myprofile'</script>";
				} else {
					$msg = "<span class=' alert alert-danger'>Profile not updated</span>";
		
					return $msg;
				}
				
			}
		
		
		}





		 public function AddProduct($data, $file){

        $product_title = mysqli_escape_string($this->db->link, $data['product_title']);

        $product_brief   = mysqli_escape_string($this->db->link, $data['product_brief']);
        $product_price   = mysqli_escape_string($this->db->link, $data['product_price']);
        $product_category   = mysqli_escape_string($this->db->link, $data['product_category']);
        $product_author =  mysqli_escape_string($this->db->link, $data['author']);
        $author_email =  mysqli_escape_string($this->db->link, $data['author_email']);
        $product_number = rand(1000, 9999);
        $product_tag = "PRC00";
        $product_serial = $product_tag . $product_number;
        $status = "pending";
        

        $permitted  = array('pdf','doc','docx','xls');
       

        
        $file_namee = $file['complete_product']['name'];
        $file_sizee = $file['complete_product']['size'];
        $file_tempp = $file['complete_product']['tmp_name'];

      
       

        $divv = explode('.', $file_namee);
        $file_extt = strtolower(end($divv));
        $unique_filee= substr(md5(time()), 0,10 ). '.' .$file_extt;

        $filee= "../Adminpanel/complete_files/".$unique_filee;

        if ($product_title== "" || $product_brief == "" || $product_price=="" || $product_category=="") {
            $msg = "<span class='alert alert-danger'>fields must not be empty</span>";

        return $msg;
        }elseif ($file_sizee > 7048567  ) {
            echo "<span class='alert alert-danger'>File allowed should be less than 7Mb.</span>";
        }elseif(in_array($file_extt, $permitted)=== false){
            echo "<span class='alert alert-danger'>You can only upload :-".implode(',', $permitted)."</span>";
        }else{
            
            move_uploaded_file($file_tempp, $filee);

            $query = "INSERT INTO product_tbl(product_title, product_brief, product_price, product_category,  product_author, product_serial, complete_fname, complete_name, status, author_email) VALUES('$product_title','$product_brief', '$product_price', '$product_category',  '$product_author', '$product_serial', '$unique_filee', '$file_namee', '$status', '$author_email' )";

            $inserttest= $this->db->insert($query);

        if ($inserttest){
            $email_admin = "admin@researchcenta.com";
                $to = $email_admin;
              $subject = "New product uploaded";
              $message = "
                <html>
                <head>
                <title>New Product from an uploader</title>
                </head>
                <body>
                <h2>To Admin: A content just got uploaded by an uploader.</h2>
                
                <h4><a href='https://researchcenta.com/adminlogin'>Click here</h4>
                </body>
                </html>
                ";
              //dont forget to include content-type on header if your sending html
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= "From: admin@researchcenta.com". "\r\n" .
                    "CC: admin@researchcenta.com";

          mail($to,$subject,$message,$headers);
            $msg= "<span class='alert alert-success'>Project successfully added.</span>";

            return $msg;
        } else {
            $msg = "<span class='alert alert-danger'>Project not inserted</span>";

            return $msg;
        }


        }

    }


    // Fetch all Approved Projects

    public function getAllAprovedProject($email, $offset, $record_per_page){
    
        $query = "SELECT * FROM product_tbl  WHERE status = 'active' AND author_email = '$email' ORDER BY product_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Fetch all Awaiting Projects

    public function getAllAwaitingProject($email, $offset, $record_per_page){
    
        $query = "SELECT * FROM product_tbl  WHERE status = 'pending' AND author_email = '$email' ORDER BY product_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // Fetch all Uploaders

    public function getAllUploaders($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Delete Uploader
    public function delProductByUploaderIdA($id){

    $query = "DELETE FROM product_tbl WHERE product_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'awaiting_approval'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>project not deleted</span>";

            return $msg;
        }
    

}

    // Delete Uploader
    public function delUploaderById($id){

    $query = "DELETE FROM uploader_tbl WHERE upload_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_uploaders'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>uploader not deleted</span>";

            return $msg;
        }
    

}

// Insert withdrawal request

public function InsertRequest($data){
    $full_name      = mysqli_escape_string($this->db->link, $data['full_name']);
    $amount = mysqli_escape_string($this->db->link, $data['amount']);
    $acct_number   = mysqli_escape_string($this->db->link, $data['acct_number']);
    $acct_name   = mysqli_escape_string($this->db->link, $data['acct_name']);
    $bank_name    = mysqli_escape_string($this->db->link, ($data['bank_name']));
    $total_balance      = mysqli_escape_string($this->db->link, ($data['total_balance']));
    $uploader_status = "pending";
    $admin_status = "pending";
    if ($full_name== "" || $amount == "" || $acct_number == "" || $acct_name == "" || $bank_name == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "INSERT INTO withdrawal_tbl(full_name, amount, acct_number,  acct_name, bank_name, uploader_status, admin_status, total_balance) VALUES('$full_name','$amount', '$acct_number','$acct_name', '$bank_name', '$uploader_status', '$admin_status', '$total_balance')";

        $rquestInsert= $this->db->insert($query);

    if ($rquestInsert){
         $email_admin = "admin@researchcenta.com";
                $to = $email_admin;
              $subject = "New payment request";
              $message = "
                <html>
                <head>
                <title>New Payment request from an uploader</title>
                </head>
                <body>
                <h2>To Admin: I request to be paid from the amount ive earned so far.</h2>
                
                <h4><a href='https://researchcenta.com/adminlogin'>Click here</h4>
                </body>
                </html>
                ";
              //dont forget to include content-type on header if your sending html
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= "From: admin@researchcenta.com". "\r\n" .
                    "CC: admin@researchcenta.com";

          mail($to,$subject,$message,$headers);
        echo"<script>alert('Request successfully sent, admin will get back to you shortly')</script>";
    } else {
        echo"<script>alert('error, request not sent')</script>";
    }
    
}
   
}

 public function getAllRequests($product_author, $offset, $record_per_page){
    
        $query = "SELECT * FROM withdrawal_tbl  WHERE uploader_status = 'pending' AND full_name = '$product_author' ORDER BY withdrawal_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // get request by ID


    public function getRequestData($id){
            $query = "SELECT * FROM withdrawal_tbl WHERE withdrawal_id = '$id' ";
        $result = $this->db->select($query);

        return $result;
        }

// update request @ uploader dashboard

        public function UpdateRequest($data, $id){
    $full_name      = mysqli_escape_string($this->db->link, $data['full_name']);
    $amount             = mysqli_escape_string($this->db->link, $data['amount']);
    $acct_number    = mysqli_escape_string($this->db->link, $data['acct_number']);
    $acct_name      = mysqli_escape_string($this->db->link, $data['acct_name']);
    $bank_name      = mysqli_escape_string($this->db->link, ($data['bank_name']));

    $id = mysqli_escape_string($this->db->link,$id);

    $uploader_status = "pending";
    $admin_status    = "pending";
    if ($full_name== "" || $amount == "" || $acct_number == "" || $acct_name == "" || $bank_name == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "UPDATE withdrawal_tbl SET amount = '$amount'  WHERE withdrawal_id = '$id'";

        $rquestInsert= $this->db->update($query);

    if ($rquestInsert){
        echo "<script>window.location = 'all_request'</script>";
    } else {
        echo"<script>alert('error, request not sent')</script>";
    }
    
}
   
}

// Fetch all Request

    public function getAllRequest($offset, $record_per_page, $table_id){
        $query = "SELECT * FROM withdrawal_tbl WHERE uploader_status = 'pending' OR uploader_status = 'accepted' AND admin_status = 'pending' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }
    // update request @ admin dashboard

        public function UpdateAdminRequest($data, $id){
    
   
    $uploader_status      = mysqli_escape_string($this->db->link, $data['uploader_status']);
    $admin_status      = mysqli_escape_string($this->db->link, ($data['admin_status']));
    $id = mysqli_escape_string($this->db->link,$id);

        $query = "UPDATE withdrawal_tbl SET uploader_status = '$uploader_status', admin_status = '$admin_status'  WHERE withdrawal_id = '$id'";

        $rquestInsert= $this->db->update($query);

    if ($rquestInsert){
        echo "<script>window.location = 'uploader_earning'</script>";
    } else {
        echo"<script>alert('error, request not sent')</script>";
    }
  
}


 // Delete Request @ Admin
    public function delRequestById($id){

    $query = "DELETE FROM withdrawal_tbl WHERE withdrawal_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'uploader_earning'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>request not deleted</span>";

            return $msg;
        }
    

}

// Delete Request @ Uploader
    public function delRequestsById($id){

    $query = "DELETE FROM withdrawal_tbl WHERE withdrawal_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_request'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>request not deleted</span>";

            return $msg;
        }
    

}


// payment history for uploader

public function getAllPayment($full_name, $offset, $record_per_page){
    
        $query = "SELECT * FROM withdrawal_tbl  WHERE uploader_status = 'accepted' AND admin_status='paid' AND delete_uploader ='0' AND full_name = '$full_name' ORDER BY withdrawal_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Delete payment @ Uploader
    public function delPaymentById($id){

    $query = "UPDATE  withdrawal_tbl SET delete_uploader = '1' WHERE withdrawal_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_payment'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>payment not deleted</span>";

            return $msg;
        }
    

}

public function getAllMessage($email, $offset, $record_per_page){
        $query = "SELECT  * FROM uploader_msg WHERE msg_email = '$email' AND uploader_delete ='0' ORDER BY msg_id DESC LIMIT $offset, $record_per_page  ";
        $result = $this->db->insert($query);
        return $result;

}

// Delete messages @ Uploader
    public function delMessageById($id){

    $query = "UPDATE  uploader_msg SET uploader_delete = '1' WHERE msg_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_messages'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}

public function getAllMessageAdmin( $offset, $record_per_page){
        $query = "SELECT * FROM uploader_msg WHERE admin_delete ='0'  ORDER BY msg_id DESC LIMIT $offset, $record_per_page";
        $result = $this->db->select($query);
        return $result;

}

// Delete messages @ Admin
    public function delMessageByIdAdmin($id){

    $query = "UPDATE  uploader_msg SET admin_delete = '1' WHERE msg_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'uploader_msg'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}

}

?>



