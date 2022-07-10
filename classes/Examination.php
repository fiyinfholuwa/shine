<?php

require_once 'Database.php';

class Examinations{
	
	private $db;

	 public	function __construct(){
			 $this->db = new Database();
		}
  // add question
		public function addQuestions($data){
    $question_name = mysqli_real_escape_string($this->db->link, $data['question_name']);
    $answer1       = mysqli_real_escape_string($this->db->link, $data['answer1']);
    $answer2       = mysqli_real_escape_string($this->db->link, $data['answer2']);
    $answer3       = mysqli_real_escape_string($this->db->link, $data['answer3']);
    $answer4       = mysqli_real_escape_string($this->db->link, $data['answer4']);
    $answer        = mysqli_real_escape_string($this->db->link, $data['answer']);
    $category_id   = mysqli_real_escape_string($this->db->link, $data['category_id']);
    
    
    if ($question_name=="" || $answer1=="" || $answer2=="" || $answer3=="" || $answer4=="" || $answer=="" ) {
      echo "<script>alert('Fill in the blank space')</script>";
    }else{
    $query = "insert into questions(question_name, answer1, answer2, answer3, answer4, answer, category_id) values('$question_name','$answer1', '$answer2', '$answer3', '$answer4', '$answer', '$category_id')";
    $insert_row = $this->db->insert($query);
    if($insert_row){
      $msg= "<span class='alert alert-success'>Question successfully added.</span>";
      return $msg;
        }else{
      echo "<script>alert('Not inserted')</script>";
    }
  }
}
  
  // get all question
  
  
  public function getAllQuestions($table_name, $table_id, $offset, $record_per_page){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // update questions

    public function updateQuestion($data, $id){
    $question_name = mysqli_real_escape_string($this->db->link, $data['question_name']);
    $answer1       = mysqli_real_escape_string($this->db->link, $data['answer1']);
    $answer2       = mysqli_real_escape_string($this->db->link, $data['answer2']);
    $answer3       = mysqli_real_escape_string($this->db->link, $data['answer3']);
    $answer4       = mysqli_real_escape_string($this->db->link, $data['answer4']);
    $answer        = mysqli_real_escape_string($this->db->link, $data['answer']);
    // $category_id   = mysqli_real_escape_string($this->db->link, $data['category_id']);
    
    
    if ($question_name=="" || $answer1=="" || $answer2=="" || $answer3=="" || $answer4=="" || $answer=="" ) {
      echo "<script>alert('Fill in the blank space')</script>";
    }else{
    $query = "update questions set question_name= '$question_name',  answer1 ='$answer1', answer2= '$answer2', answer3='$answer3', answer4='$answer4', answer='$answer' where id = '$id' ";
    $insert_row = $this->db->update($query);
    if($insert_row){
       echo "<script>window.location='all_question'</script>";
        }else{
      echo "<script>alert('Not inserted')</script>";
    }
  }
}
   

   // Delete question
  public function delQuestionById($id){

  $query = "DELETE FROM questions WHERE id = '$id'";

  $delete_row = $this->db->delete($query);

  if ($delete_row) {
    // echo "<script>alert('Message deleted sucessfully')</script>";
      echo "<script>window.location = 'all_question'</script>";
  
    } else {
      $msg = "<span class='alert alert-danger'>question not deleted</span>";

      return $msg;
    }
  

}


// add essay
    public function addEssay($data){
    
    $essay_topic   = mysqli_real_escape_string($this->db->link, $data['essay_topic']);
    $essay_status="pending";
    
    if ($essay_topic=="" ) {
      echo "<script>alert('Fill in the blank space')</script>";
    }else{
    $query = "insert into essay_tbl(essay_topic, essay_status) values('$essay_topic','$essay_status')";
    $insert_row = $this->db->insert($query);
    if($insert_row){
      $msg= "<span class='alert alert-success'>Essay successfully added.</span>";
      return $msg;
        }else{
      echo "<script>alert('Not inserted')</script>";
    }
  }
}

// get all essays
  
  
  public function getAllEssays($table_name, $table_id, $offset, $record_per_page){
        $query = "SELECT * FROM $table_name ORDER BY $table_id DESC LIMIT $offset, $record_per_page";
        $result= $this->db->select($query);
        return $result;
       
    }

    // update essay
    public function updateEssay($data, $id){
    
    $essay_topic   = mysqli_real_escape_string($this->db->link, $data['essay_topic']);
    
    
    if ($essay_topic=="" ) {
      echo "<script>alert('Fill in the blank space')</script>";
    }else{
    $query = "update essay_tbl set essay_topic= '$essay_topic' where essay_id = '$id' ";
    $insert_row = $this->db->update($query);
    if($insert_row){
     echo "<script>window.location = 'all_essay'</script>";
        }else{
      echo "<script>alert('Not inserted')</script>";
    }
  }
}


// Delete question
  public function delEssayById($id){

  $query = "DELETE FROM essay_tbl WHERE essay_id = '$id'";

  $delete_row = $this->db->delete($query);

  if ($delete_row) {
    // echo "<script>alert('Message deleted sucessfully')</script>";
      echo "<script>window.location = 'all_essay'</script>";
  
    } else {
      $msg = "<span class='alert alert-danger'>question not deleted</span>";

      return $msg;
    }
  

}

}
?>


