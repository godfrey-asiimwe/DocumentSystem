<?php
  include ('../DB.php');
  require_once ("../Class/DB.class.php");
  require_once ("../Class/Doc.class.php");
  $doc = new Doc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Dashboard &mdash; ModelSchool</title>

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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Type', 'Quantity'],
          ['Issued',    <?php echo $result1=$doc->getAllIssuedDocuments($con); ?> ],
          ['Ready',     <?php echo $result1=$doc->getAllReadyDocuments($con); ?>],
          ['Not Ready', <?php echo $result1=$doc->getAllNotReadyDocuments($con); ?>]
        ]);

        var options = {
          title: 'Model High Documents'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Passlips', 'Certificates'],
          ['2017', <?php echo $doc->getAllPasslipsByYear($con,'2017'); ?>,<?php echo $doc->getAllCertificatesbyYear($con,'2017'); ?>],
          ['2018',  <?php echo $doc->getAllPasslipsByYear($con,'2018'); ?>, <?php echo $doc->getAllCertificatesbyYear($con,'2018'); ?>],
          ['2019',  <?php echo $doc->getAllPasslipsByYear($con,'2019'); ?>,<?php echo $doc->getAllCertificatesbyYear($con,'2019'); ?>],
          ['2020',  <?php echo $doc->getAllPasslipsByYear($con,'2020'); ?>,<?php echo $doc->getAllCertificatesbyYear($con,'2020'); ?>],
          ['2021',  <?php echo $doc->getAllPasslipsByYear($con,'2021'); ?>,<?php echo $doc->getAllCertificatesbyYear($con,'2021'); ?>]
        ]);

        var options = {
          title: 'Document Status',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
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
            <div class="d-sm-none d-lg-inline-block">Hi, Welcome Admin</div></a>
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
            <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item  active">
                <a href="" class="nav-link ">
                  <i class="fas fa-fire"></i><span>Dashboard</span>
                </a>
              </li>

               <li class="menu-header">Documents</li>
              <li class="nav-item  active">
                <a href="document.php" class="nav-link ">
                  <i class="fas fa-fire"></i><span>Ready</span>
                </a>
                <a href="notreadydoc.php" class="nav-link ">
                  <i class="fa fa-file"></i><span>Un Ready</span>
                </a>
                <a href="issuedDoc.php" class="nav-link ">
                  <i class="fa fa-user"></i><span>Issued</span>
                </a>
              </li>

            <li class="menu-header">Users</li>
            <li class="nav-item  active">
              <a href="users.php" class="nav-link ">
                <i class="fa fa-user"></i><span>Users</span>
              </a>
            </li>
            </ul>
        </aside>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-2">
                
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Passlips</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo number_format($result=$doc->getAllPasslips($con));
                   ?>
                  </div>
                </div>
              </div>
            </div>
              <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-2">
                 
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Certificates</h4>
                  </div>
                  <div class="card-body">
                   <?php
                    echo number_format($result=$doc->getAllCertificates($con));
                   ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Amounted Demanded</h4>
                  </div>
                  <div class="card-body">

                   <?php
                    echo number_format($result=$doc->getTotalBalance($con));
                   ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12">
              <div class="card card-statistic-2">
                
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Amount Recieved</h4>
                  </div>
                  <div class="card-body">
                    <?php
                    echo number_format($result=$doc->getTotalAmountPaid($con));
                   ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
             <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>DashBoard</h4>
                </div>
                <div class="card-body p-0">
                  <div class="row">  
                    <div class="col-lg-5">
                      <div id="piechart" style="width:100%; height: 400px;"></div>
                    </div>
                    <div class="col-lg-7">
                      <div id="curve_chart" style="width:100%; height: 400px"></div>
                    </div>
                  </div>
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
</body>
</html>
