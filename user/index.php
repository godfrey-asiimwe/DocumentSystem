<?php

include ('../DB.php');
require_once ("../Class/DB.class.php");
require_once ("../Class/Doc.class.php");
require_once ("../Class/Roles.Class.php");

// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
  header('Location: ../index.php');
  exit;
}

//adding databse configuration file
include_once '../DB.php';

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/jqvmap/dist/jqvmap.min.css">
  <link rel="stylesheet" href="../node_modules/summernote/dist/summernote-bs4.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.carousel.min.css">
  <link rel="stylesheet" href="../node_modules/owl.carousel/dist/assets/owl.theme.default.min.css">

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
                <a href="/ModelSchool/user" class="nav-link " style="margin-bottom: 10px;">
                  <i class="fas fa-copy fa-7x" style="font-size:27px;"></i><span>Ready </span>
                </a>
                <a href="notreadydoc.php" class="nav-link " style="margin-bottom: 10px;">
                  <i class="far fa-file-pdf" style="font-size:30px;"></i><span>Not Ready</span>
                </a>
                <a href="issuedDoc.php" class="nav-link ">
                <i class="fas fa-archive" style="font-size:30px;"></i><span>Issued</span>
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
                    <h4 style="font-size: 23px !important;">Documents Ready to Be Issued</h4>
                    <div class="card-header-action">
                      <?php

                      $roles = new Roles();
                      $role = $roles->getSpecificRole($role_id,$con);

                      if($role==='Issue'){

                      }else{

                      ?>
                      <button   data-toggle="modal" data-target="#logoutModal" class="dropdown-item has-icon text-danger btn btn-primary" style="color: white !important;" class="btn btn-primary">Add Document</button>

                      <?php
                        }
                      ?>
                    </div>
                  </div>
                  <div class="card-body p-0">
                     
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered mb-0" id="example">
                        <?php 
                        if($role==='Issue'){
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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                          $doc = new Doc();
                          $result=$doc->getAllActiveDocs();

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
                              <td><a  class="btn btn-primary issue" data-id='<?php echo $result[$k]["id"];?>' id="<?php echo $result[$k]["id"];?>" style="color: white !important;">Issue</a></td>
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
                          $result=$doc->getAllActiveDocs();

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
                              <td> <?php  echo $result[$k]["status"];?></td>

                            </tr>
                          <?php
                            }
                          }
                        }

                        ?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
          </div>
        </section>
      </div>

       <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add a Document </h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="doc"  method='post' action='' enctype="multipart/form-data">
                 
                  <div class="form-group col-md-12 col-lg-12">
                    <label>Document No.</label>
                    <input type="text" name="code" id="code" class="form-control" required>
                  </div>
                   <div class="form-group col-md-8 col-lg-8">
                    <label>Select Level</label>
                    <select class="form-control" name="level" id="level">
                      <option value="UACE">UACE</option>
                      <option value="UCE">UCE</option>
                    </select>
                  </div>
                  <div class="form-group col-md-8 col-lg-8">
                    <label>Select Document Type</label>
                    <select class="form-control" name="type" id="type">
                      <option value="passlip">Passlip</option>
                      <option value="certificate">Certificate</option>
                    </select>
                  </div>
                   <div class="form-group col-md-12 col-lg-12">
                    <label>Holder (full Names)</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label>Reg.NO</label>
                    <input type="text" name="regno" id="regno" class="form-control" required>
                  </div>
                   <div class="form-group col-md-12 col-lg-12">
                    <label>Doc Year</label>
                    <input type="date" name="year" id="year" class="form-control" required>
                  </div>
                  <div class="form-group col-md-12 col-lg-12">
                    <label>Amount Demanded</label>
                    <input type="text" name="amount" id="amount" class="form-control" required>
                  </div>
                     <input type="hidden" name="docid" id="docid" />
                     <input type="submit" name="add_doc" id="add_doc" value="Save" class="btn btn-success" /> 
              </form>
          </div>
          </div>
        </div>
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
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->
  <script src="../node_modules/jquery-sparkline/jquery.sparkline.min.js"></script>
  <script src="../node_modules/chart.js/dist/Chart.min.js"></script>
  <script src="../node_modules/owl.carousel/dist/owl.carousel.min.js"></script>
  <script src="../node_modules/summernote/dist/summernote-bs4.js"></script>
  <script src="../node_modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

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

  <script type="text/javascript">

    $(document).ready(function(){
    
      $('#add_doc').on('click', function(){

          $code= $('#code').val();
          $level= $('#level').val();
          $name= $('#name').val();
          $regno= $('#regno').val();
          $year= $('#year').val();
          $amount= $('#amount').val();
          $type= $('#type').val();
          
          $.ajax({
            type: "POST",
            url: "ajaxfile.php",
            data: {

              code: $code,
              level: $level,
              name: $name,
              regno: $regno,
              year: $year,
              amount: $amount,
              type: $type,
              
            },
            success: function(){

             $("#doc")[0].reset();
             $("#sortable-table").load(" #sortable-table");
             alert(" Successfully Saved");

            }
          });
      });
    });



    $(document).ready(function(){ 

        $('.issue').click(function(){
            var el = this;

            // document id
            var id = $(this).data('id');
            
            var confirmalert = confirm(" You are about to Issue a document, Are you sure?");
            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                    url: 'issue_doc.php',
                    type: 'POST',
                    data: { id:id },
                    success: function(response){
        
                        if(response == 1){

                          alert('You have successfuly Issued the Doc');
                            
                        }else{
                            alert('Invalid ID.');
                        }
                    }
                });
            }
        });

    });
  </script>
</body>
</html>
