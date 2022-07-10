<?php
require_once 'Database.php';
require_once 'Session.php';


class Writers extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

//    Insert users

public function InsertWriter($data){
    $first_name      = mysqli_escape_string($this->db->link, $data['first_name']);
    $last_name = mysqli_escape_string($this->db->link, $data['last_name']);
    $tel   = mysqli_escape_string($this->db->link, $data['tel']);
    $email   = mysqli_escape_string($this->db->link, $data['email']);
    $password    = mysqli_escape_string($this->db->link, md5($data['password']));
    $conf_password = mysqli_escape_string($this->db->link, md5($data['conf_password']));
    $verify_token = rand(10, 100000);
    $verify_email = 0;
    $status = "pending";
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
    
    $mailquery = "SELECT * FROM writer_tbl WHERE email = '$email' LIMIT 1 ";

    $mailchk = $this->db->select($mailquery);

    if ($mailchk !=false) {
        echo"<script>alert('Email already registered')</script>";
    }else{
        $query = "INSERT INTO writer_tbl(first_name, last_name, tel,  email, password, conf_password, verify_token, verify_email, status ) VALUES('$first_name','$last_name', '$tel','$email', '$password', '$conf_password', '$verify_token', '$verify_email', '$status')";

        $writerInsert= $this->db->insert($query);

    if ($writerInsert){
        // echo"<script>alert('You can check your email for verification')</script>";
        //sending email verification
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
                <h4><a href='https://researchcenta.com/centa/writeractivate?uid=$email&code=$verify_token'>Activate My Account</h4>
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

        public function writerLogin($data){
            $email   = mysqli_escape_string($this->db->link, $data['email']);
            $password = mysqli_escape_string($this->db->link, md5($data['password']));

            if (empty($email) || empty($password)) {
                echo"<script>alert('Fill in the blank space')</script>";
            }else{
                
            $query = "SELECT * FROM writer_tbl WHERE email ='$email' AND password = '$password' AND verify_email = '1' AND status = 'pending' ";

            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();

                Session::set("writerPreLog", true);
                Session::set ("writerId", $value['writer_id']);
                Session::set ("email", $value['email']);
                Session::set ("status", $value['status']);

                echo "<script>window.location = 'writer_details'</script>";

            }

            $statuss = "active";

            if($statuss == "active"){ 
                $query = "SELECT * FROM writer_tbl WHERE email ='$email' AND password = '$password' AND verify_email = '1' AND status = 'active' ";
            

            $result = $this->db->select($query);
            if ($result != false) {
                $value = $result->fetch_assoc();

                Session::set("writerLog", true);
                Session::set ("writerId", $value['writer_id']);
                Session::set ("email", $value['email']);

                echo "<script>window.location = 'writer/dashboard'</script>";

            }else{
                $msg = "<span style='color:red;' class=' alert alert-danger'>Email or Password doesnot match</span>";

                return $msg;
            }
        }
}

}




        public function UpdateProfile($data, $id){
                $fullname      = mysqli_escape_string($this->db->link, $data['fullname']);
                $email = mysqli_escape_string($this->db->link, $data['email']);
                // $phone   = mysqli_escape_string($this->db->link, $data['phone']);
                // $education   = mysqli_escape_string($this->db->link, $data['education']);
                $city   = mysqli_escape_string($this->db->link, $data['city']);
                $country   = mysqli_escape_string($this->db->link, $data['country']);
                // $address   = mysqli_escape_string($this->db->link, $data['address']);
                $acct_name   = mysqli_escape_string($this->db->link, $data['acct_name']);
                $bank_name   = mysqli_escape_string($this->db->link, $data['bank_name']);
                $acct_num   = mysqli_escape_string($this->db->link, $data['acct_num']);
                
            $id = mysqli_escape_string($this->db->link,$id);
        
            if ($fullname=="" || $city=="" || $email=="") {
                $msg = "<span class='alert alert-danger'>fields must not be empty</span>";
        
                return $msg;
            }else {
                $query = "UPDATE writer_details SET fullname = '$fullname', email= '$email', city='$city', country = '$country',  acct_name='$acct_name', bank_name='$bank_name', acct_num='$acct_num' WHERE writer_id = '$id'";
        
                $update_row = $this->db->update($query);
                if ($update_row) {
                    echo "<script>alert('profile updated sucessfully')</script>";
                    echo "<script>window.location = 'myprofile'</script>";
                } else {
                    $msg = "<span class=' alert alert-danger'>Profile not updated</span>";
        
                    return $msg;
                }
                
            }
        
        
        }


        
        // Fetch all Users

    public function getAllWriters($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Delete User
    public function delWriterById($id){

    $query = "DELETE FROM writer_tbl WHERE writer_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_writers'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>writer not deleted</span>";

            return $msg;
        }
    

}

// GEt writer information

public function getWriterData($id){
            $query = "SELECT * FROM writer_details WHERE writer_id = '$id' ";
        $result = $this->db->select($query);

        return $result;
        }


    // Fetch all orders in respective to writer email

    public function getAllOrdersToWriter($writer_dept, $offset, $record_per_page){
        $query = "SELECT * FROM order_tbl WHERE status = 'active' AND assigned_writer = 'Writers Found' AND user_payment_status = 'approve' AND paper_category = '$writer_dept'  AND writer_status = 'pending' || writer_status='work_in_progress' ORDER BY order_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    public function getAllOrdersToWriterSelected($writer_dept, $email, $offset, $record_per_page){
        $query = "SELECT * FROM order_tbl WHERE status = 'active' AND assigned_writer = 'Writers Found' AND user_payment_status = 'approve' AND paper_category = '$writer_dept'  AND writer_status = 'I can do it' AND writer_selected = '$email' ORDER BY order_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


// Fetch all orders in respective to writer email complete

    public function getAllOrdersToWriterComplete($writer_dept, $email, $offset, $record_per_page){
        $query = "SELECT * FROM order_tbl WHERE status = 'active' AND assigned_writer = 'Writers Found' AND user_payment_status = 'approve' AND paper_category = '$writer_dept'  AND writer_status = 'done' AND writer_selected = '$email' ORDER BY order_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    public function AddToUserOrder($file, $id, $email){

        
        
        $permitted  = array('pdf','doc','docx','xls');
        $file_name = $file['file']['name'];
        $file_size = $file['file']['size'];
        $file_temp = $file['file']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_file= substr(md5(time()), 0,10 ). '.' .$file_ext;

        $uploaded_file= "complete_order/".$unique_file;

        if ($file_name=="") {
            echo "<script>alert('select a file to upload')</script>";
        }elseif ($file_size > 7048567) {
           echo "<script>alert('image allowed should be less than 7mb')</script>";
        }elseif(in_array($file_ext, $permitted)=== false){
            echo "<span class='alert alert-danger'>You can only upload :-".implode(',', $permitted)."</span>";
        }else{
            move_uploaded_file($file_temp, $uploaded_file);

            $query = "update order_tbl set cname ='$file_name' , fcname = '$unique_file', writer_status= 'admin_verify' where writer_selected='$email' and order_id = '$id' ";

            $updateOrder= $this->db->update($query);

        if ($updateOrder){
            echo "<script>alert('file sent to the admin for vetting')</script>";

            echo "<script>window.location='recommended_order'</script>";
        } else {
            echo "<script>alert('file not sent')</script>";

            
        }


        }

    }


    // Insert withdrawal request writer

public function InsertRequest($data){
    $full_name      = mysqli_escape_string($this->db->link, $data['full_name']);
    $amount = mysqli_escape_string($this->db->link, $data['amount']);
    $acct_number   = mysqli_escape_string($this->db->link, $data['acct_number']);
    $acct_name   = mysqli_escape_string($this->db->link, $data['acct_name']);
    $bank_name    = mysqli_escape_string($this->db->link, ($data['bank_name']));
    $total_balance      = mysqli_escape_string($this->db->link, ($data['total_balance']));
    $writer_status = "pending";
    $admin_status = "pending";
    if ($full_name== "" || $amount == "" || $acct_number == "" || $acct_name == "" || $bank_name == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "INSERT INTO writer_withdrawal_tbl(full_name, amount, acct_number,  acct_name, bank_name, writer_status, admin_status, total_balance) VALUES('$full_name','$amount', '$acct_number','$acct_name', '$bank_name', '$writer_status', '$admin_status',
        '$total_balance')";

        $rquestInsert= $this->db->insert($query);

    if ($rquestInsert){
        echo"<script>alert('Request successfully sent, admin will get back to you shortly')</script>";
    } else {
        echo"<script>alert('error, request not sent')</script>";
    }
    
}
   
}


public function getAllRequests($full_name, $offset, $record_per_page){
    
        $query = "SELECT * FROM writer_withdrawal_tbl  WHERE writer_status = 'pending' AND full_name = '$full_name' ORDER BY withdrawal_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // get request by ID


    public function getRequestData($id){
            $query = "SELECT * FROM writer_withdrawal_tbl WHERE withdrawal_id = '$id' ";
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
        $query = "UPDATE writer_withdrawal_tbl SET amount = '$amount'  WHERE withdrawal_id = '$id'";

        $rquestInsert= $this->db->update($query);

    if ($rquestInsert){
        echo "<script>window.location = 'all_request'</script>";
    } else {
        echo"<script>alert('error, request not sent')</script>";
    }
    
}
   
}

// Fetch all Request @admin

    public function getAllRequest($offset, $record_per_page, $table_id){
        $query = "SELECT * FROM writer_withdrawal_tbl WHERE writer_status = 'pending' OR writer_status = 'accepted' AND admin_status = 'pending' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }
    // update request @ admin dashboard

        public function UpdateAdminRequest($data, $id){
    
   
    $writer_status      = mysqli_escape_string($this->db->link, $data['writer_status']);
    $admin_status      = mysqli_escape_string($this->db->link, ($data['admin_status']));
    $id = mysqli_escape_string($this->db->link,$id);

        $query = "UPDATE writer_withdrawal_tbl SET writer_status = '$writer_status', admin_status = '$admin_status'  WHERE withdrawal_id = '$id'";

        $rquestInsert= $this->db->update($query);

    if ($rquestInsert){
        echo "<script>window.location = 'writer_earning'</script>";
    } else {
        echo"<script>alert('error, request not sent')</script>";
    }
  
}


 // Delete Request @ Admin
    public function delRequestById($id){

    $query = "DELETE FROM writer_withdrawal_tbl WHERE withdrawal_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'writer_earning'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>request not deleted</span>";

            return $msg;
        }
    

}

// Delete Request @ Uploader
    public function delRequestsById($id){

    $query = "DELETE FROM writer_withdrawal_tbl WHERE withdrawal_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_request'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>request not deleted</span>";

            return $msg;
        }
    

}

public function InsertFine($data){
    $fine_description      = mysqli_escape_string($this->db->link, $data['fine_description']);
    $fine_amount = mysqli_escape_string($this->db->link, $data['fine_amount']);
    $fine_writer   = mysqli_escape_string($this->db->link, $data['fine_writer']);
   
    if ($fine_description== "" || $fine_amount == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "INSERT INTO fine_tbl(fine_description, writer_fine, fine_amount) VALUES('$fine_description', '$fine_writer', '$fine_amount')";

        $finsert= $this->db->insert($query);

    if ($finsert){

                $to = $fine_writer;
              $subject = "Fine Alert";
              $message = "
                <html>
                <head>
                <title>Fine alert</title>
                </head>
                <body>
                <h2>To Admin: ". $fine_description ."</h2>
                
                <h4><a href='https://researchcenta.com/centa/writerlogin'>Click here</h4>
                </body>
                </html>
                ";
              //dont forget to include content-type on header if your sending html
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= "From: admin@researchcenta.com". "\r\n" .
                    "CC: admin@researchcenta.com";

          mail($to,$subject,$message,$headers);
        echo"<script>alert('input amount is successfully removed')</script>";
    } else {
        echo"<script>alert('error, amount not removed')</script>";
    }
    
}
   
}

 public function getAllFine($offset, $record_per_page, $table_id){
        $query = "SELECT * FROM fine_tbl WHERE delete_admin = '0'  ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // Delete Fine @ Admin
    public function delFineById($id){

    $query = "update fine_tbl set delete_admin= '1' WHERE fine_id = '$id'";

    $delete_row = $this->db->update($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_fine'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>fine not deleted</span>";

            return $msg;
        }
    

}

public function UpdateFine($data, $id){
    $fine_description      = mysqli_escape_string($this->db->link, $data['fine_description']);
    $fine_amount = mysqli_escape_string($this->db->link, $data['fine_amount']);
    $fine_writer   = mysqli_escape_string($this->db->link, $data['fine_writer']);
   
    if ($fine_description== "" || $fine_amount == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "update fine_tbl set fine_description = '$fine_description', writer_fine = '$fine_writer', fine_amount= '$fine_amount' where fine_id = '$id' ";

        $finsert= $this->db->insert($query);

    if ($finsert){
        echo"<script>alert('fine successfully updated')</script>";
        echo "<script>window.location = 'all_fine'</script>";
    } else {
        echo"<script>alert('error, amount not removed')</script>";
    }
    
}
   
}




public function InsertBonus($data){
    $bonus_description      = mysqli_escape_string($this->db->link, $data['bonus_description']);
    $bonus_amount = mysqli_escape_string($this->db->link, $data['bonus_amount']);
    $bonus_writer   = mysqli_escape_string($this->db->link, $data['bonus_writer']);
   
    if ($bonus_description== "" || $bonus_amount == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "INSERT INTO bonus_tbl(bonus_description, bonus_writer, bonus_amount) VALUES('$bonus_description', '$bonus_writer', '$bonus_amount')";

        $finsert= $this->db->insert($query);

    if ($finsert){

                $to = $bonus_writer;
              $subject = "Bonus Alert";
              $message = "
                <html>
                <head>
                <title>Bonus alert</title>
                </head>
                <body>
                <h2>To Admin: ". $bonus_description ."</h2>
                
                <h4><a href='https://researchcenta.com/centa/writerlogin'>Click here</h4>
                </body>
                </html>
                ";
              //dont forget to include content-type on header if your sending html
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              $headers .= "From: admin@researchcenta.com". "\r\n" .
                    "CC: admin@researchcenta.com";

          mail($to,$subject,$message,$headers);
        echo"<script>alert('input amount is successfully added to the writer')</script>";
    } else {
        echo"<script>alert('error, amount not added')</script>";
    }
    
}
   
}

 public function getAllBonus($offset, $record_per_page, $table_id){
        $query = "SELECT * FROM bonus_tbl WHERE delete_admin = '0'  ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // Delete Fine @ Admin
    public function delBonusById($id){

    $query = "update bonus_tbl set delete_admin= '1' WHERE bonus_id = '$id'";

    $delete_row = $this->db->update($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_bonus'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>fine not deleted</span>";

            return $msg;
        }
    

}

public function UpdateBonus($data, $id){
    $bonus_description      = mysqli_escape_string($this->db->link, $data['bonus_description']);
    $bonus_amount = mysqli_escape_string($this->db->link, $data['bonus_amount']);
    $bonus_writer   = mysqli_escape_string($this->db->link, $data['bonus_writer']);
   
    if ($bonus_description== "" || $bonus_amount == "") {
        echo"<script>alert('Fill in the blank Space')</script>";   
    }else{
        $query = "update bonus_tbl set bonus_description = '$bonus_description', bonus_writer = '$bonus_writer', bonus_amount= '$bonus_amount' where bonus_id = '$id' ";

        $finsert= $this->db->update($query);

    if ($finsert){
        echo"<script>alert('Bonus successfully updated')</script>";
        echo "<script>window.location = 'all_bonus'</script>";
    } else {
        echo"<script>alert('error, bonus not updated')</script>";
    }
    
}
   
}

// getting all fines for writer dashboard

public function getAllFineW($email, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM fine_tbl WHERE writer_fine = '$email' AND delete_writer = '0'  ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // Delete Fine @ writer dashboard
    public function delFineByIdW($id){

    $query = "update fine_tbl set delete_writer= '1' WHERE fine_id = '$id'";

    $delete_row = $this->db->update($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_fine'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>fine not deleted</span>";

            return $msg;
        }
    
}
    // getting all bonus for writer dashboard

  public function getAllBonusW($email, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM  bonus_tbl WHERE bonus_writer = '$email' AND delete_writer = '0'  ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // Delete bonus @ writer dashboard
    public function delBonusByIdW($id){

    $query = "update bonus_tbl set delete_writer= '1' WHERE bonus_id = '$id'";

    $delete_row = $this->db->update($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'all_bonus'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>bonus not deleted</span>";

            return $msg;
        }
    

}

// payment history

public function getAllPayment($full_name, $offset, $record_per_page){
    
        $query = "SELECT * FROM writer_withdrawal_tbl  WHERE writer_status = 'accepted' AND admin_status='paid' AND delete_writer ='0' AND full_name = '$full_name' ORDER BY withdrawal_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Delete Request @ Uploader
    public function delPaymentById($id){

    $query = "UPDATE  writer_withdrawal_tbl SET delete_writer = '1' WHERE withdrawal_id = '$id'";

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
        $query = "SELECT  * FROM writer_msg WHERE msg_email = '$email' AND writer_delete ='0' ORDER BY msg_id DESC LIMIT $offset, $record_per_page  ";
        $result = $this->db->select($query);
        return $result;

}

// Delete messages @ Uploader
    public function delMessageById($id){

    $query = "UPDATE  writer_msg SET writer_delete = '1' WHERE msg_id = '$id'";

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
        $query = "SELECT * FROM writer_msg WHERE admin_delete ='0'  ORDER BY msg_id DESC LIMIT $offset, $record_per_page";
        $result = $this->db->select($query);
        return $result;

}

// Delete messages @ Admin
    public function delMessageByIdAdmin($id){

    $query = "UPDATE  writer_msg SET admin_delete = '1' WHERE msg_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'writer_msg'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}

public function getAllComplainForOrder($email, $offset, $record_per_page){
        $query = "SELECT * FROM order_complain_tbl   WHERE writer_selected = '$email' AND user_status = 'approve' AND writer_delete='0' ORDER BY complain_id DESC LIMIT $offset, $record_per_page";
        $result = $this->db->select($query);
        return $result;

}

// Admin Complain @ Writer
public function getAllComplainFromAdmin($email, $offset, $record_per_page){
        $query = "SELECT * FROM admin_complain  WHERE writer_selected = '$email' AND writer_delete = '0' ORDER BY complain_id DESC LIMIT $offset, $record_per_page";
        $result = $this->db->select($query);
        return $result;

}



public function getAllFeedbackAdmin($offset, $record_per_page){
        $query = "SELECT * FROM admin_complain   WHERE admin_delete = '0' ORDER BY complain_id DESC LIMIT $offset, $record_per_page";
        $result = $this->db->select($query);
        return $result;

}

// Delete AdminFeedback @ Admin
    public function delAdminFeedbackById($id){

    $query = "UPDATE  admin_complain SET admin_delete = '1' WHERE complain_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'feedback_from_writer'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}

// Delete AdminFeedback @ Writer Dashboard
    public function delAdminFeedbackWriterById($id){

    $query = "UPDATE  admin_complain SET writer_delete = '1' WHERE complain_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'order_complain_admin'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}


// Delete AdminFeedback @ Writer Dashboard
    public function delUserComplain($id){

    $query = "UPDATE  order_complain_tbl SET writer_delete = '1' WHERE complain_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'order_complain'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}

}

?>

