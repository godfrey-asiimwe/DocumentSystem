<?php
session_start();
// Change this to your connection info.
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash;Document System</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
</head>
<body>
    <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="assets/img/model.png" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>


            <?php

              include 'DB.php';

                // Now we check if the data from the login form was submitted, isset() will check if the data exists.
              if(isset($_POST['submit'])){

                if ( !isset($_POST['email'], $_POST['password']) ) {
                  // Could not get the data that should have been sent.
                  exit('Please fill both the username and password fields!');
                }

                if($_POST['email']=='admin@gmail.com'){

                       // Prepare our SQL, preparing the SQL statement will prevent SQL injection.

                        if ($stmt = $con->prepare('SELECT tid, password FROM admin WHERE email = ?')) {

                          // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                          $stmt->bind_param('s', $_POST['email']);
                          $stmt->execute();

                          // Store the result so we can check if the account exists in the database.
                          $stmt->store_result();

                          if ($stmt->num_rows > 0) {

                          $stmt->bind_result($id, $password);
                          $stmt->fetch();
                          
                          // Account exists, now we verify the password.
                          if (md5($_POST['password'])=== $password) {

                            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.

                            session_regenerate_id();
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['email'] = $_POST['email'];
                            $_SESSION['tid'] = $id;
                           
                            header('Location:admin/');
                            
                          }else{
                            echo 'The user does not exit in the system';
                          }

                        }

                      }

                  
                }else{

                        // Prepare our SQL, preparing the SQL statement will prevent SQL injection.

                        if ($stmt = $con->prepare('SELECT id, password FROM users WHERE email = ?')) {

                          // Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
                          $stmt->bind_param('s', $_POST['email']);
                          $stmt->execute();

                          // Store the result so we can check if the account exists in the database.
                          $stmt->store_result();

                          if ($stmt->num_rows > 0) {

                          $stmt->bind_result($id, $password);
                          $stmt->fetch();
                          
                          // Account exists, now we verify the password.
                          if (md5($_POST['password']) === $password) {

                            // Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.

                            session_regenerate_id();
                            $_SESSION['loggedin'] = TRUE;
                            $_SESSION['email'] = $_POST['email'];
                            $_SESSION['id'] = $id;
                           
                            header('Location:user/');
                            
                          }else{
                            echo 'The user does not exit in the system';
                          }

                        }

                      }
                }  
            }
          ?>

              <div class="card-body">
                <form method="POST" action="<?php echo $_SERVER['SCRIPT_NAME']?>" class="needs-validation" novalidate="">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Please fill in your email
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                      <label for="password" class="control-label">Password</label>
                      <div class="float-right">
                        <a href="" class="text-small">
                          Forgot Password?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                      please fill in your password
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
              
              </div>
            </div>
            <div class="simple-footer">
              Copyright &copy; ModelSchool
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
