<?php

function Flash($name, $text=""){
     if(isset($_SESSION[$name])){
          $success = $_SESSION[$name];
          $error = $_SESSION[$name];

          unset($_SESSION[$name]);
         
         
          return $success;
     }else{
          $_SESSION[$name]=$text;
     }
     return "";
}
?>