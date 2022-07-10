
<?php 

$host = "localhost";
$user = "root";
$pass = "";
$db   = "shine";
$con = null;

try {
  $con = new PDO("mysql:host={$host};dbname={$db};",$user,$pass);
} catch (Exception $e) {
  
}


 ?>

<?php $conn = new mysqli("localhost","root","","shine"); ?>




<?php

define("DB_HOST", "localhost");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "shine");


Class Database{
 public $host   = DB_HOST;
 public $user   = DB_USER;
 public $pass   = DB_PASS;
 public $dbname = DB_NAME;
 
 
 public $link;
 public $error;
 
 public function __construct(){
  $this->connectDB();
 }
 
private function connectDB(){
 $this->link = new mysqli($this->host, $this->user, $this->pass, 
  $this->dbname);
 if(!$this->link){
   $this->error ="Connection fail".$this->link->connect_error;
  return false;
 }
 }
 
// Select or Read data
public function select($query){
  $result = $this->link->query($query) or die($this->link->error.__LINE__);
  if($result->num_rows > 0){
    return $result;
  } else {
    return false;
  }
 }
 
// Insert data
public function insert($query){
 $insert_row = $this->link->query($query) or die($this->link->error.__LINE__);
 if($insert_row){
   return $insert_row;
 } else {
   return false;
  }
 }
  
// Update data
 public function update($query){
 $update_row = $this->link->query($query) or  die($this->link->error.__LINE__);
 if($update_row){
  return $update_row;
 } else {
  return false;
  }
 }
  
// Delete data
 public function delete($query){
 $delete_row = $this->link->query($query) or die($this->link->error.__LINE__);
 if($delete_row){
   return $delete_row;
 } else {
   return false;
  }
 }
 
}





?>


<?php
/**
* Format Class
*/
class Format{
  public function formatDate($date){
    return date('F j, Y, g:i a', strtotime($date));
  }

  public function textShorten($text, $limit = 400){
    $text = $text. " ";
    $text = substr($text, 0, $limit);
    $text = substr($text, 0, strrpos($text, ' '));
    $text = $text.".....";
    return $text;
  }

  public function validation($data){
    $data = trim($data);
    $data = stripcslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  public function title(){
    $path = $_SERVER['SCRIPT_FILENAME'];
    $title = basename($path, '.php');
    //$title = str_replace('_', ' ', $title);
    if ($title == 'index') {
      $title = 'home';
    }elseif ($title == 'contact') {
      $title = 'contact';
    }
    return $title = ucfirst($title);
  }

}
?>