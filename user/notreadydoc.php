<?php
session_start();
ob_start();
include ('../DB.php');
require_once ("../Class/DB.class.php");
require_once ("../Class/Doc.class.php");
require_once ("../Class/Roles.Class.php");

// We need to use sessions, so you should always start sessions using the below code.

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit;
}

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT email,firstname,lastname,id,role_id FROM users WHERE id = ?');

// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email,$firstname,$lastname,$id,$role_id);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>User Dashboard &mdash; ModelSchool</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Template CSS -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/components.css">
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
          </ul>
         
        </form>
        <ul class="navbar-nav navbar-right">
         
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?php echo $lastname ?> <?php echo $firstname; ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
             
              <div class="dropdown-divider"></div>
              <a href="../logout.php" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand ">
            <a href="index.html">Model School</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">MS</a>
          </div>
             <ul class="sidebar-menu"><br>
              <li class="menu-header" style="font-weight: bolder;font-size: 13px;">Documents</li>
              <li class="nav-item active" style="padding-bottom: 30px;">
                <a href="index.php" class="nav-link " style="margin-bottom: 10px;">
                  <i class="fas fa-copy fa-7x" ></i><span>Ready </span>
                </a>
                <a href="notreadydoc.php" class="nav-link " style="margin-bottom: 10px;">
                  <i class="far fa-file-pdf" ></i><span>Not Ready</span>
                </a>
                <a href="issuedDoc.php" class="nav-link ">
                <i class="fas fa-archive" ></i><span>Issued</span>
                </a>
              </li>
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
               <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 style="font-size: 23px !important;">Not Ready Documents</h4>
                    <div class="card-header-action">
                      <?php
                      $doc = new Doc();
                      $roles = new Roles();
                      $role = $roles->getSpecificRole($role_id,$con);

                      if($role==='Issue'){

                      }else{

                      }
                      ?>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <?php if(isset($_GET['makePayment'])){
                        include 'makePayment.php';
                    }else{ ?>
                    <div class="table-responsive">
                      <table class="table table-striped" id="example">
                        <?php 

                        if($role ==='Issue'){
                          ?>
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Level</th>
                            <th>Holder</th>
                            <th>Reg. no</th>
                            <th>Issue Year</th>
                            <th>Initial Demanded</th>
                            <th>Balance</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          
                          $result=$doc->getAllNotReadyDocs();

                          if (! empty($result)) {

                            foreach ($result as $k => $v) {
                            ?>

                            <tr>
                              <td><?php echo $result[$k]["Code"]; ?></td>
                              <td><?php echo $result[$k]["level"]; ?></td>
                              <td><?php  echo $result[$k]["Holder"];?></td>
                              <td><?php  echo $result[$k]["reg_no"];?></td>
                              <td><?php  echo $result[$k]["issue_year"];?></td>
                              <td><?php  echo number_format($result[$k]["payment"]);?></td>
                              <td><?php  echo number_format($result[$k]["balance"]);?></td>
                              <td><?php  echo $result[$k]["status"];?></td>
                            </tr>

                          <?php
                            }
                          }

                          }else{

                        ?>
                        <thead>
                          <tr>
                            <th>Code</th>
                            <th>Level</th>
                            <th>Holder</th>
                            <th>Reg. no</th>
                            <th>Issue Year</th>
                            <th>Initial Demanded</th>
                            <th>Balance</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $doc = new Doc();
                          $result=$doc->getAllNotReadyDocs();

                          if (! empty($result)) {

                              foreach ($result as $k => $v) {
                              ?>
                            <tr>

                              <td> <?php echo $result[$k]["Code"]; ?></td>
                              <td> <?php echo $result[$k]["level"]; ?></td>
                              <td> <?php  echo $result[$k]["Holder"];?></td>
                              <td> <?php  echo $result[$k]["reg_no"];?></td>
                              <td> <?php  echo $result[$k]["issue_year"];?></td>
                              <td><?php  echo number_format($result[$k]["payment"]);?></td>
                              <td><?php  echo number_format($result[$k]["balance"]);?></td>
                               <td><a href="notreadydoc.php?makePayment=<?php echo $result[$k]["id"];?>" class="btn btn-primary issue" style="color: white !important;">Make Payment</a></td>

                            </tr>
                          <?php
                            }
                          }
                        }

                        ?>
                        </tbody>
                      </table>
                    </div>

                    <?php }?>
                  </div>
                </div>
              </div>
          </div>
        </section>
      </div>

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="">Godfrey Asiimwe</a>
        </div>
        <div class="footer-right">
          1.0
        </div>
      </footer>
    </div>
  </div>

  <!-- General JS Scripts -->
  <script src="../assets/js/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="../assets/js/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="../assets/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="..assets/js/jquery.nicescroll.min.js"></script>
  <script src="../assets/js/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="../assets/js/scripts.js"></script>
  <script src="../assets/js/custom.js"></script>

  <!-- Page Specific JS File -->
  <script src="../assets/js/page/index.js"></script>
  <!-- Page Specific JS File -->
  <script src="../assets/js/page/components-table.js"></script>

  <script src="../assets/js/jquery.dataTables.min.js"></script>
  <script src="../assets/js/dataTables.bootstrap4.min.js"></script>

  <script type="text/javascript">
    
    $(document).ready(function() {

        $('#example').DataTable();

      } );
  </script>

</body>
</html>
