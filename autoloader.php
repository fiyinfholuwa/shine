<?php 

spl_autoload_register('myLoader');

function myLoader($className) {
    $path = "classes/";
    $extention =".php";
    $full_path = $path.$className.$extention;
    if (!file_exists($full_path)) {
        return false;
    }
    include_once $full_path;

}
?>