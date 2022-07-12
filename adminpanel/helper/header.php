<?php 
require_once "../classes/flashMessage.php";
require_once "../classes/Database.php";
require_once "../classes/Post.php";
require_once "../classes/Category.php";
require_once "../classes/Audios.php";
require_once "../classes/Download.php";
require_once "../classes/Award.php";
require_once "../classes/Team.php";
require_once "../classes/Contact.php";



spl_autoload_register('myLoader');

function myLoader($className) {
    $path = "../classes/";
    $extention =".php";
    $full_path = $path.$className.$extention;
    if (!file_exists($full_path)) {
        return false;
    }
    include_once $full_path;

}

 ?>

<?php
session_start();
if(!isset($_SESSION['admin_id']) )
{
 echo "<script>window.open('../adminlogin','_self')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Shining Star - Admin Panel</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <link rel="stylesheet" href="assets/css/toastr.min.css">
  
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='../images/logo.jpg' />
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i data-feather="align-justify"></i></a></li>
            
          </ul>
        </div>
        <ul class="navbar-nav navbar-right">
       
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image" src="assets/img/user.jpg"
                class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <div class="dropdown-title">Hello Admin</div>
              <a href="../" target="_blank" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                Main-Website
              </a> <a href="../academy/" target="_blank" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
               Academy
              </a>
              <div class="dropdown-divider"></div>
              <a href="auth-login.html" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>
                Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>