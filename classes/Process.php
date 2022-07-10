<?php

require_once 'Database.php';

class Process{
	
	private $db;
  // private $fm;

	 public	function __construct(){
			 $this->db = new Database();
       // $this->fm = new Format();
		}

		public function processData($data){
    $selectedAns        = mysqli_real_escape_string($this->db->link, $data['ans'] );
    $number               = mysqli_real_escape_string($this->db->link, $data['number'] );
    $next                    = $number+1;
    if(!isset($_SESSION['score'])){
      $_SESSION['score'] = '0'; 
    }
    $total = $this->getTotal();
    $right = $this->rightAns($number);
    if($right == $selectedAns ){
      $_SESSION['score']++;
    }
    if($number == $total){
     echo "<script>window.location = 'result'</script>";
      exit();
    }else{
      // header("Location: quiztest?q=".$next);

      echo "<script>window.location = 'quiztest?q=$next'</script>";
    }
  }
  private function getTotal(){
    $query = "select * from tbl_ques";
    $getResult = $this->db->select($query);
    $total = $getResult->num_rows;
    return $total;
  }
  private function rightAns($number){
     $query = "select * from tbl_ans where quesNo = '$number' and rightAns = '1'";
    $getdata = $this->db->select($query)->fetch_assoc();
    $result = $getdata['id'];
    return $result;
  }

}
?>


