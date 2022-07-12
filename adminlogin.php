
<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Shine - Star Admin-login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="adminpanel/assets/css/app.min.css">
  <link rel="stylesheet" href="adminpanel/assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="adminpanel/assets/css/style.css">
  <link rel="stylesheet" href="adminpanel/assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="adminpanel/assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='images/logo.jpg' />
</head>
<?php
require_once "classes/Database.php";
session_start();
if(isset($_SESSION['admin_id']))
{
  echo "<script>window.open('adminpanel/','_self')</script>";
}



if(isset($_POST['login']))
{
  $username = $_POST['username'];
  $password = $_POST['password'];
  if(empty($username) || empty($password))
  {
     // $error = "Input password or username";
      echo "<script>alert('Input Password or Username')</script>";
  }
  else
  {
    $query = "SELECT * FROM admin_tbl WHERE username = '$username' AND password = '$password'";
    $execution = mysqli_query($conn, $query) or die(mysqli_error($conn));
    if($result = mysqli_fetch_assoc($execution))
    {
      $_SESSION['admin_id'] = $result['admin_id'];
      $_SESSION['username'] = $result['username'];
    

      $login = "Login Successfully";
      
      echo "<script>window.open('adminpanel/','_self')</script>";

    }
    else
    {
      echo "<script>alert('Wrong username or password')</script>";
    }
  }
}

?>
<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Admin-Login</h4>

                <img height="50" width="80" src="images/logo.jpg" />
              </div>
              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in the username
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <button type="submit" name="login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="adminpanel/assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="adminpanel/assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="adminpanel/assets/js/custom.js"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->
</html>