<?php
session_start();

function count1($tab)
{
	$sqlc="select count(*) as total from $tab";
	$resc=$GLOBALS['con']->query($sqlc);
	$rowc=$resc->fetch_assoc();
	$total_count=$rowc['total'];
	return $total_count;
}

if(isset($_SESSION['uid']))
{
	$user=$_SESSION['uid'];
}
include("conn.php");
if(isset($_REQUEST['log'])=="1")
{
session_destroy();
echo "<script>window.location='../index.php'</script>";	
}

if(!isset($user))
{
	echo "<script>window.location='../index.php'</script>";	
}
else
{
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Stud-Tracker</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../template/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="../template/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../template/template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../template/template/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../template/template/vendors/ti-icons/css/themify-icons.css">
<!--  <link rel="stylesheet" type="text/css" href="../template/template/js/select.dataTables.min.css">
-->  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../template/template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../template/template/images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <img src="../New folder/EMC logo.png" width="200">
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>        
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      
      
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php?disp=assign">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Assign Subject</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php?disp=view_batches">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">View Batches</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php?disp=view_schedule">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">View Class Schedule</span>
            </a>
          </li>
         
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Add New</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="adminhome.php?disp=add_dept">Department</a></li>
                <li class="nav-item"><a class="nav-link" href="adminhome.php?disp=add_batch">Batch</a></li>
                <li class="nav-item"><a class="nav-link" href="adminhome.php?disp=add_subject">Subject</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Teacher</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="adminhome.php?disp=add_teach">Add New</a></li>
                <li class="nav-item"> <a class="nav-link" href="adminhome.php?disp=view_teachers">View All</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
              <i class="icon-contract menu-icon"></i>
              <span class="menu-title">Students</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="adminhome.php?disp=new_student">Add New</a></li>
                <li class="nav-item"> <a class="nav-link" href="adminhome.php?disp=view_students">View All</a></li>
              </ul>
            </div>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="adminhome.php?log=1">
              <i class="icon-paper menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
      <?php
	  		if(isset($_REQUEST['disp'])!="")
			//if($_REQUEST['disp']<>"")
			{
				$path="class.php";
				
				if(file_exists($path))
				{
				include_once($path);
				$obj=new book;
				}
				else
				{
					echo "page cannot found";
				}
			}
			
			else
			{
			?>
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin">
              <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                  <h3 class="font-weight-bold">Welcome Admin</h3>
                  <h6 class="font-weight-normal mb-0">All systems are running smoothly!</h6>
                </div>
                <!--<div class="col-12 col-xl-4">
                 <div class="justify-content-end d-flex">
                  <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                    <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                     <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                      <a class="dropdown-item" href="#">January - March</a>
                      <a class="dropdown-item" href="#">March - June</a>
                      <a class="dropdown-item" href="#">June - August</a>
                      <a class="dropdown-item" href="#">August - November</a>
                    </div>
                  </div>
                 </div>
                </div>-->
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card tale-bg">
                <div class="card-people mt-auto">
                  <img src="../New folder/student-management-banner-1920x1080-1-1024x576.png" alt="people" width="550">
                  
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
              <div class="row">
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-tale">
                    <div class="card-body">
                      <p class="mb-4">Total Departments</p>
                      <p class="fs-30 mb-2">
					  <?php 
					  $t="department";
					  echo count1($t);
					   ?>
                      </p>
                      <p>active</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-4 stretch-card transparent">
                  <div class="card card-dark-blue">
                    <div class="card-body">
                      <p class="mb-4">Total Batches</p>
                      <p class="fs-30 mb-2">
                      <?php 
					  $t="batches";
					  echo count1($t);
					   ?>
                      </p>
                      <p>active</p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                  <div class="card card-light-blue">
                    <div class="card-body">
                      <p class="mb-4">Number of Teachers</p>
                      <p class="fs-30 mb-2">
                      <?php 
					  $t="teachers";
					  echo count1($t);
					   ?>
                      </p>
                      <p>active</p>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 stretch-card transparent">
                  <div class="card card-light-danger">
                    <div class="card-body">
                      <p class="mb-4">Number of Students</p>
                      <p class="fs-30 mb-2">
                      <?php 
					  $t="students";
					  echo count1($t);
					   ?>
                      </p>
                      <p>active</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
		}
		?>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023. <a href="" target="_blank">Stud-Tracker</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Developed by names <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../template/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!--<script src="../template/template/vendors/chart.js/Chart.min.js"></script>
  <script src="../template/template/vendors/datatables.net/jquery.dataTables.js"></script>
  <script src="../template/template/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
  <script src="../template/template/js/dataTables.select.min.js"></script>-->

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <!--<script src="../template/template/js/off-canvas.js"></script>
  <script src="../template/template/js/hoverable-collapse.js"></script>-->
<!--  <script src="../template/template/js/template.js"></script>
-->  <!--<script src="../template/template/js/settings.js"></script>-->
<!--  <script src="../template/template/js/todolist.js"></script>
-->  <!-- endinject -->
  <!-- Custom js for this page-->
 <!-- <script src="../template/template/js/dashboard.js"></script>
  <script src="../template/template/js/Chart.roundedBarCharts.js"></script>-->
  <!-- End custom js for this page-->
</body>

</html>
<?php
}
?>
