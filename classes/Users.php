<?php
require_once 'Database.php';
require_once 'Session.php';


class Users extends Database{
    private $db;

     private $fm;

     public function __construct(){
             $this->db = new Database();
            
        }

//    Insert users

public function InsertUser($data){
	$first_name 	 = mysqli_escape_string($this->db->link, $data['first_name']);
	$last_name = mysqli_escape_string($this->db->link, $data['last_name']);
	$tel   = mysqli_escape_string($this->db->link, $data['tel']);
	$email   = mysqli_escape_string($this->db->link, $data['email']);
	$password 	 = mysqli_escape_string($this->db->link, md5($data['password']));
	$conf_password = mysqli_escape_string($this->db->link, md5($data['conf_password']));
	$verify_token = rand(10, 100000);
	$verify_email = 0;
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
	
	$mailquery = "SELECT * FROM users WHERE email = '$email' LIMIT 1 ";

	$mailchk = $this->db->select($mailquery);

	if ($mailchk !=false) {
		echo"<script>alert('Email already registered')</script>";
	}else{
		$query = "INSERT INTO users(first_name, last_name, tel,  email, password, conf_password, verify_token, verify_email) VALUES('$first_name','$last_name', '$tel','$email', '$password', '$conf_password', '$verify_token', '$verify_email')";

		$userInsert= $this->db->insert($query);

	if ($userInsert){
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
				<h4><a href='https://researchcenta.com/useractivate?uid=$email&code=$verify_token'>Activate My Account</h4>
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

        public function userLogin($data){
			$email 	 = mysqli_escape_string($this->db->link, $data['email']);
			$password = mysqli_escape_string($this->db->link, md5($data['password']));

			if (empty($email) || empty($password)) {
				$msg = "<span style='color:red;' class='alert alert-danger'>Fil in the Email and the Password</span>";

				return $msg;
			}else{
				
			$query = "SELECT * FROM users WHERE email ='$email' AND password = '$password' AND verify_email = '1' ";

			$result = $this->db->select($query);
			if ($result != false) {
				$value = $result->fetch_assoc();

				Session::set("userLog", true);
				Session::set ("userId", $value['user_id']);
				Session::set ("email", $value['email']);

				echo "<script>window.location = 'user/dashboard'</script>";

			}else{
				$msg = "<span style='color:red;' class='alert alert-danger'>Email or Password doesnot match</span>";

				return $msg;
            }
        }

		}


		public function getUserData($id){
			$query = "SELECT * FROM users WHERE user_id = '$id' ";


		$result = $this->db->select($query);

		return $result;
		}



		public function UpdateProfile($data, $id){
				$first_name 	 = mysqli_escape_string($this->db->link, $data['first_name']);
				$last_name = mysqli_escape_string($this->db->link, $data['last_name']);
				$tel   = mysqli_escape_string($this->db->link, $data['tel']);
				$email   = mysqli_escape_string($this->db->link, $data['email']);
                
			$id = mysqli_escape_string($this->db->link,$id);
		
			if ($first_name=="" || $last_name=="" || $tel=="" || $email=="") {
				$msg = "<span class='alert alert-danger'>fields must not be empty</span>";
		
				return $msg;
			}else {
				$query = "UPDATE users SET first_name = '$first_name', last_name= '$last_name', tel = '$tel', email = '$email' WHERE user_id = '$id'";
		
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


		// Make Order

		public function userOrder($data, $file){

			$user_details  = mysqli_escape_string($this->db->link, $data['user_details']);
			$topic = mysqli_escape_string($this->db->link, $data['topic']);
			$paper_type = mysqli_escape_string($this->db->link, $data['paper_type']);
			$paper_category = mysqli_escape_string($this->db->link, $data['paper_category']);
			$page_number = mysqli_escape_string($this->db->link, $data['page_number']);
			$deadline = mysqli_escape_string($this->db->link, $data['deadline']);
			// $topic = mysqli_escape_string($this->db->link, $data['topic']);
			$academic_level = mysqli_escape_string($this->db->link, $data['academic_level']);
			$paper_brief = mysqli_escape_string($this->db->link, $data['paper_brief']);
			$email = mysqli_escape_string($this->db->link, $data['email']);
			$assigned_writer ="none";
			 $order_number = rand(1000, 9999);
        	$order_tag = "RC00";
        	$order_serial = $order_tag . $order_number;

			$permitted  = array('pdf','docx', '');
	        $file_name = $file['file_upload']['name'];
	        $file_size = $file['file_upload']['size'];
	        $file_temp = $file['file_upload']['tmp_name'];

	        $div = explode('.', $file_name);
	        $file_ext = strtolower(end($div));
	        $unique_file= substr(md5(time()), 0,10 ). '.' .$file_ext;

	        $uploaded_file= "file_upload/".$unique_file;

	        if ($topic=="" || $page_number==""  ) {
	            $msg = "<span class='alert alert-danger'>fields must not be empty</span>";

	        return $msg;
	        }elseif ($file_size > 7048567) {
	            echo "<span class='alert alert-danger'>Image allowed should be less than 7Mb.</span>";
	        }elseif(in_array($file_ext, $permitted)=== false){
	            echo "<span class='alert alert-danger'>You can only upload :-".implode(',', $permitted)."</span>";
	        }else{
	            move_uploaded_file($file_temp, $uploaded_file);

	            $query = "INSERT INTO order_tbl(user_details, order_serial, topic, paper_type, paper_category, page_number, deadline, academic_level, paper_brief, fname, name, assigned_writer, email) VALUES('$user_details', '$order_serial', '$topic', '$paper_type', '$paper_category','$page_number','$deadline', '$academic_level','$paper_brief', '$unique_file', '$file_name', '$assigned_writer','$email')";

	            $insertorder= $this->db->insert($query);

	        if ($insertorder){
	        	$email_admin = "admin@researchcenta.com";
	        	$to = $email_admin;
			$subject = "Order Alert";
			$message = "
				<html>
				<head>
				<title>New Order</title>
				</head>
				<body>
				<h2>Login to validate the order for further processing.</h2>
				
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

	            $msg= "<span class='alert alert-success'>Order successfully sent.</span>";

	            return $msg;
	        } else {
	            $msg = "<span class='alert alert-danger'>Order not sent</span>";

	            return $msg;
	        }


	        }

		}


// GEt order information

public function getSingleOrder($id){
            $query = "SELECT * FROM order_tbl WHERE order_id = '$id' ";
        $result = $this->db->select($query);

        return $result;
        }


		// Fetch all Users

    public function getAllUsers($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Delete User
	public function delUserById($id){

	$query = "DELETE FROM users WHERE user_id = '$id'";

	$delete_row = $this->db->delete($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
			echo "<script>window.location = 'all_users'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>user not deleted</span>";

			return $msg;
		}
	

}


// Fetch all User Orders

    public function getAllOrdersFromUser($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name WHERE delete_admin = '0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

 // public function getAllOrdersForUserssss($user_details, $offset, $record_per_page, $table_id){
 //        $query = "SELECT * FROM order_tbl WHERE  delete_user ='0'  AND user_details = '$user_details'  AND status = 'pending' || status='active' AND writer_status = 'pending' OR writer_status = 'i can do it' OR user_payment_status = 'approve'   ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
 //        $result= $this->db->select($query);
 //        return $result;
       
 //    }
    // Fetch recents/ pended orders User Orders @ user dashboard

    public function getAllOrdersForUser($user_details, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM order_tbl WHERE  delete_user ='0'  AND user_details = '$user_details'  AND status = 'pending' || status = 'active' AND writer_status = 'pending' || writer_status= 'i can do it' || writer_status = 'admin_verify'   ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    // Fetch recents/ accepted orders User Orders @ user dashboard

    public function getAllOrdersForUserFinished($user_details, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM order_tbl WHERE user_details = '$user_details' AND status = 'active' AND writer_status = 'done' AND delete_user='0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

     //Complaints orders User Orders @ user dashboard

    public function getAllComplaints($email, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM order_complain_tbl WHERE email = '$email'  AND user_delete='0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // Fetch recents/ cancelled orders User Orders @ user dashboard

    public function getAllOrdersForUserCancelled($user_details, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM order_tbl WHERE user_details = '$user_details' AND status = 'cancelled' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


     // Delete User order @ USERDASHBOARD
	public function delOrderByIdUser($id){

	$query = "UPDATE  order_tbl SET delete_user = '1' WHERE order_id = '$id'";

	$delete_row = $this->db->update($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('order successfully deleted')</script>";
			echo "<script>window.location = 'recent_order'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>order not deleted</span>";

			return $msg;
		}
	

}


// Delete User order @ USERDASHBOARD
	public function delOrderComplaints($id){

	$query = "UPDATE  order_complain_tbl SET user_delete = '1' WHERE complain_id = '$id'";

	$delete_row = $this->db->update($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('Order complaint successfully deleted')</script>";
			echo "<script>window.location = 'all_complaints'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>order not deleted</span>";

			return $msg;
		}
	

}


 // Delete User order @ USERDASHBOARD
	public function delOrderByIdUserFinished($id){

	$query = "UPDATE  order_tbl SET delete_user = '1' WHERE order_id = '$id'";

	$delete_row = $this->db->update($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('order successfully deleted')</script>";
			echo "<script>window.location = 'finished_order'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>order not deleted</span>";

			return $msg;
		}
	

}



// Delete User order @ USERDASHBOARD
	public function delOrderByIdUserCancelled($id){

	$query = "DELETE FROM order_tbl WHERE order_id = '$id'";

	$delete_row = $this->db->delete($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('order successfully deleted')</script>";
			echo "<script>window.location = 'cancelled_order'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>order not deleted</span>";

			return $msg;
		}
	

}


// Delete User order @ AdminDASHBOARD
	public function delOrderByIdAmin($id){

	$query = "UPDATE  order_tbl SET delete_admin = '1' WHERE order_id = '$id'";

	$delete_row = $this->db->update($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('order successfully deleted')</script>";
			echo "<script>window.location = 'all_orders'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>order not deleted</span>";

			return $msg;
		}
}


 public function getAllOrdersForPurchased($email, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM payment_tbl WHERE email = '$email' AND payment_status = 'paid' AND delete_user='0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete User catalog @ USERDASHBOARD
	public function delOrderByIdUserPurchase($id){

	$query = "UPDATE payment_tbl SET delete_user='1' WHERE payment_id = '$id'";

	$delete_row = $this->db->delete($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('project file successfully deleted')</script>";
			echo "<script>window.location = 'mycatalog'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>order not deleted</span>";

			return $msg;
		}
	

}

    public function getAllBalance($email, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM userbalance_tbl WHERE email = '$email' AND payment_status = 'paid' AND delete_user = '0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }


    public function getAllDebit($email, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM payment_tbl WHERE email = '$email' AND payment_status = 'paid' AND debit_user = '0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }



// / Delete User order @ USERDASHBOARD
	public function delBalanceByIdUser($id){

	$query = "UPDATE userbalance_tbl SET delete_user = '1'  WHERE balance_id = '$id'";

	$delete_row = $this->db->delete($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('payment history successfully deleted')</script>";
			echo "<script>window.location = 'transaction_history'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>history not deleted</span>";

			return $msg;
		}
	

}


// / Delete User Debit @ USERDASHBOARD
	public function delDebitByIdUser($id){

	$query = "UPDATE payment_tbl SET debit_user = '1'  WHERE payment_id = '$id'";

	$delete_row = $this->db->delete($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
		echo "<script>alert('debit history successfully deleted')</script>";
			echo "<script>window.location = 'debit_history'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>debit history not deleted</span>";

			return $msg;
		}
	

}

// Messages to admin vice versa


public function getAllMessage($email, $offset, $record_per_page){
        $query = "SELECT  * FROM user_msg WHERE msg_email = '$email' AND user_delete ='0' ORDER BY msg_id DESC LIMIT $offset, $record_per_page  ";
        $result = $this->db->select($query);
        return $result;

}

// Delete messages @ User
    public function delMessageById($id){

    $query = "UPDATE  user_msg SET user_delete = '1' WHERE msg_id = '$id'";

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
        $query = "SELECT * FROM user_msg WHERE admin_delete ='0'  ORDER BY msg_id DESC LIMIT $offset, $record_per_page";
        $result = $this->db->select($query);
        return $result;

}

// Delete messages @ Admin
    public function delMessageByIdAdmin($id){

    $query = "UPDATE  user_msg SET admin_delete = '1' WHERE msg_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        // echo "<script>alert('Message deleted sucessfully')</script>";
            echo "<script>window.location = 'user_msg'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Message not deleted</span>";

            return $msg;
        }
    

}

public function getAllComplainAdmin( $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM order_complain_tbl WHERE admin_delete = '0' ORDER BY $table_id  DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete messages @ Admin
    public function delAdminComplain($id){

    $query = "UPDATE  order_complain_tbl SET admin_delete = '1' WHERE complain_id = '$id'";

    $delete_row = $this->db->delete($query);

    if ($delete_row) {
        echo "<script>alert('Complaint deleted sucessfully')</script>";
            echo "<script>window.location = 'all_complaints'</script>";
    
        } else {
            $msg = "<span class='alert alert-danger'>Complaint not deleted</span>";

            return $msg;
        }
    

}



}

?>

