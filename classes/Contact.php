<?php

require_once 'Database.php';
require_once 'flashMessage.php';

class ContactUs{
	
	private $db;

	 public	function __construct(){
			 $this->db = new Database();
		}

// Insert Contact uS

public function InsertContactUs($name, $email, $phone, $message){

			$name = mysqli_escape_string($this->db->link,$name);
			$email = mysqli_escape_string($this->db->link,$email);
			$phone = mysqli_escape_string($this->db->link,$phone);
			$message = mysqli_escape_string($this->db->link,$message);

			if ($name=="" || $email=="" || $phone==""  || $message=="") {
				Flash("error",  "Fill in the empty space");;
				
		
			}else{
				$query = "INSERT INTO main_contact(name, email, phone, message) VALUES('$name', '$email', '$phone', '$message')";
				$contactInsert= $this->db->insert($query);

				if ($contactInsert){
					
                Flash("success",  "message sent successfully, we will get back to you shortly");
                } else {
                    Flash("error",  "Message not sent");
                }
				
			}
}


public function InsertContact($full_name, $email, $phone, $message){

	$name = mysqli_escape_string($this->db->link,$full_name);
	$email = mysqli_escape_string($this->db->link,$email);
	$phone = mysqli_escape_string($this->db->link,$phone);
	$message = mysqli_escape_string($this->db->link,$message);

	if ($name=="" || $email=="" || $phone==""  || $message=="") {
		Flash("error",  "Fill in the empty space");;
		

	}else{
		$query = "INSERT INTO contact_tbl(full_name, email, phone, message) VALUES('$name', '$email', '$phone', '$message')";
		$contactInsert= $this->db->insert($query);

		if ($contactInsert){
			echo "<script>
			setTimeout(function(){
			   window.location.href = 'contact';
			}, 1500);
		 </script>";	
		Flash("success",  "message sent successfully, we will get back to you shortly");
		} else {
			Flash("error",  "Message not sent");
		}
		
	}
}

public function InsertEnroll($full_name, $email, $phone, $address, $nationality, $state){

	$name = mysqli_escape_string($this->db->link,$full_name);
	$email = mysqli_escape_string($this->db->link,$email);
	$phone = mysqli_escape_string($this->db->link,$phone);
	$address = mysqli_escape_string($this->db->link,$address);
	$nationality = mysqli_escape_string($this->db->link,$nationality);
	$state = mysqli_escape_string($this->db->link,$state);

	if ($name=="" || $email=="" || $phone==""  || $address==""||  $nationality=="" || $state=="" ) {
		Flash("error",  "Fill in the empty space");;
		

	}else{
		$query = "INSERT INTO enroll_tbl(full_name, email, phone, address, nationality, state) VALUES('$name', '$email', '$phone', '$address', '$nationality', '$state')";
		$contactInsert= $this->db->insert($query);
		if ($contactInsert){
			echo "<script>
			setTimeout(function(){
			   window.location.href = 'enroll';
			}, 1500);
		 </script>";	
		Flash("success",  "message sent successfully, we will get back to you shortly");
		} else {
			Flash("error",  "Message not sent");
		}
		
	}
}

// Get All contact us

 public function getAllMessages($table_name, $offset, $record_per_page, $table_id){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

// Delete Messages
	public function delMessageById($id){

	$query = "DELETE FROM contact_main_tbl WHERE contact_id = '$id'";

	$delete_row = $this->db->delete($query);

	if ($delete_row) {
		// echo "<script>alert('Message deleted sucessfully')</script>";
			echo "<script>window.location = 'feedback'</script>";
	
		} else {
			$msg = "<span class='alert alert-danger'>Message not deleted</span>";

			return $msg;
		}
	

}



		

}
