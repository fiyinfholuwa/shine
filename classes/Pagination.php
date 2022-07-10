<?php

require_once 'Database.php';

class Pagination extends Database{
	
	private $db;

	 private $fm;

	 public	function __construct(){
			 $this->db = new Database();
		}
        

    public function Paginate($table, $no_of_record_per_page){
        $query = "SELECT * FROM $table";
        $result = $this->db->select($query);
        $total_record = mysqli_num_rows($result);
       
            $total_pages = ceil($total_record / $no_of_record_per_page);
            return $total_pages;
        }


// admin message to uploader

         public function PaginateUPAdmin($table, $no_of_record_per_page){
        $query = "select * from $table where admin_delete ='0' ";
        $result = $this->db->select($query);
        $total_record = mysqli_num_rows($result);
       
            $total_pages = ceil($total_record / $no_of_record_per_page);
            return $total_pages;
        }

        // admin message to writer

         public function PaginateWRAdmin($table, $no_of_record_per_page){
        $query = "select * from $table where admin_delete ='0' ";
        $result = $this->db->select($query);
        $total_record = mysqli_num_rows($result);
       
        $total_pages = ceil($total_record / $no_of_record_per_page);
        return $total_pages;
        }


// uploader message to admin

         public function PaginateUP($table, $email, $no_of_record_per_page){
        $query = "select * from $table where uploader_delete ='0' ";
        $result = $this->db->select($query);
        $total_record = mysqli_num_rows($result);
       
            $total_pages = ceil($total_record / $no_of_record_per_page);
            return $total_pages;
        }

        // user message to admin

         public function PaginateUS($table, $email, $no_of_record_per_page){
        $query = "select * from $table where user_delete ='0' ";
        $result = $this->db->select($query);
        $total_record = mysqli_num_rows($result);
       
            $total_pages = ceil($total_record / $no_of_record_per_page);
            return $total_pages;
        }
        
        // writer message to admin

         public function PaginateWR($table, $email, $no_of_record_per_page){
        $query = "select * from $table where writer_delete ='0' ";
        $result = $this->db->select($query);
        $total_record = mysqli_num_rows($result);
       
            $total_pages = ceil($total_record / $no_of_record_per_page);
            return $total_pages;
        }
        

        // pagination for uploader 
        public function PaginateUploaderProject($table, $status, $email, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE status ='$status' AND author_email = '$email' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }


// pagination for user orders
            public function PaginateUserOrder( $full_name, $no_of_record_per_page){
            $query = "SELECT * FROM order_tbl WHERE delete_user = '0' AND  user_details = '$full_name' AND status = 'pending'  AND writer_status = 'pending' OR status='active' OR writer_status = 'i can do it' OR user_payment_status = 'approve' OR user_payment_status = 'pending' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

 // complain order for user dashboard
            public function PaginateUserComplain( $email, $no_of_record_per_page){
            $query = "SELECT * FROM order_complain_tbl WHERE email = '$email'  AND user_delete='0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            // pagination for user orders
            public function PaginateUserOrderFinished($table, $status, $full_name, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE status ='$status' AND user_details = '$full_name' AND writer_status = 'done' AND  delete_user = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }
            
       // / pagination for user catalog
            public function PaginateUserCatalog($table, $email, $status, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE email ='$email' AND payment_status = '$status' AND delete_user= '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }
            

            // pagination for uplooader request
            public function PaginateUploaderRequest($table, $product_author, $status, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE full_name ='$product_author' AND uploader_status = '$status' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }


            // pagination for uplooader request
            public function PaginateWriterRequest($table, $full_name, $status, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE full_name ='$full_name' AND writer_status = '$status' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }


            // pagination for payment history uploader
            public function PaginateUploaderAllPayment($table, $product_author, $status, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE full_name ='$product_author' AND uploader_status = '$status' AND admin_status = 'paid' AND delete_uploader = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            // pagination for payment history writer
            public function PaginateWriterAllPayment($table, $full_name, $status, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE full_name ='$full_name' AND writer_status = '$status' AND admin_status = 'paid' AND delete_writer = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            // pagination for order writer management


       public function PaginateOrderWriterAvailable($email,  $no_of_record_per_page){
            $query = "SELECT * FROM order_tbl WHERE status = 'active' AND assigned_writer = '$email'  AND writer_status = 'pending' || writer_status='work_in_progress'";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

             public function PaginateOrderWriterComplete($email,  $no_of_record_per_page){
            $query = "SELECT * FROM order_tbl WHERE status = 'active' AND assigned_writer = '$email'  AND writer_status = 'done'";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }


            public function PaginateAB($table, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE delete_admin = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            public function PaginateABW($table, $email, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE writer_fine = '$email' AND delete_writer = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            public function PaginateABWB($table, $email, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE bonus_writer = '$email' AND delete_writer = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }


             public function PaginateUserPayment($table, $email, $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE email = '$email' AND payment_status = 'paid' AND delete_user = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            public function PaginateWriterAllRequest($table,  $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE writer_status = 'pending' OR writer_status = 'accepted' AND admin_status = 'pending'";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            public function PaginateUploaderAllRequest($table,  $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE uploader_status = 'pending' OR uploader_status = 'accepted' AND admin_status = 'pending'";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }
    
    public function PaginateAllOrders($table,  $no_of_record_per_page){
            $query = "SELECT * FROM $table WHERE delete_admin ='0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }


            public function PaginateUserDebit($table, $email,  $no_of_record_per_page){
            $query = "SELECT * FROM payment_tbl WHERE email = '$email' AND payment_status = 'paid' AND debit_user = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

            public function PaginateAdminComplain($table, $no_of_record_per_page){
            $query = "SELECT * FROM order_complain_tbl WHERE admin_delete = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

             public function PaginateAdminFeed($no_of_record_per_page){
            $query = "SELECT * FROM admin_complain WHERE admin_delete = '0' ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

             public function PaginateAdminSend($email, $no_of_record_per_page){
            $query = "SELECT * FROM admin_complain  WHERE writer_selected = '$email' AND writer_delete = '0' ORDER BY complain_id ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }

         public function PaginateUserSend($email, $no_of_record_per_page){
            $query = "SELECT * FROM order_complain_tbl   WHERE writer_selected = '$email' AND user_status = 'approve' AND writer_delete='0' ORDER BY complain_id ";
            $result = $this->db->select($query);
            $total_record = mysqli_num_rows($result);
           
                $total_pages = ceil($total_record / $no_of_record_per_page);
                return $total_pages;
            }
}
?>



