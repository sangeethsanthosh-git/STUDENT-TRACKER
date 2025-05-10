<?php
session_start();
include("phpfiles/conn.php");
if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) 
			{	
				$username=$_POST['username'];
				$password=$_POST['password'];
				
               if($username == 'admin' && $password == 'ams') 
					{
				  		$_SESSION['uid']="admin";
						echo "<script type='text/javascript'> window.location.href='phpfiles/adminhome.php'; </script>";
            		}
			   
			   		else 
					{
						$sql="select * from login where username='$username' and password='$password'";
						$result=$con->query($sql);
						$count=$result->num_rows;
						if($count>0)
						{
							$row=$result->fetch_assoc();
							$_SESSION['uid']=$row['userid'];
							
							if($row['status']==0)
							{
								if($row['type']=="teacher")
								{
									echo "<script type='text/javascript'> window.location.href='phpfiles/staffhome.php'; </script>";								
								}
								else if($row['type']=="student")
								{
									echo "<script type='text/javascript'> window.location.href='phpfiles/userhome.php'; </script>";	
								}
							}
							else
							{
                  			echo "<script type='text/javascript'> alert('Sorry, You cant login');</script>";
							}
						}
						else
						{
                  			echo "<script type='text/javascript'> alert('Invalid Username or Password');</script>";
						}
               		}
            }
			
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Stud-Tracker</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="template/template/vendors/feather/feather.css">
  <link rel="stylesheet" href="template/template/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="template/template/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css-->
  <link rel="stylesheet" href="template/template/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="template/template/images/favicon.png" />
</head>

<body>
 <div class="container-scroller" style="background-image: url('New folder/Free         Dark Color Simple Background (1).jpeg'); background-repeat: no-repeat; background-size: cover;">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="New folder/EMC logo.png" alt="logo" width="500">
              </div>
              <h6 class="font-weight-light">Hello! let's get started</h6>
              <form class="pt-3" method="post">
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username" name="username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password" name="password">
                </div>
                <div class="mt-3">
                  <input type="submit" name="login" id="button" value="Submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
               </div>
              </form>
              <p></p>
              <p align="center"><a href="index.php">back to home</a></p>
              
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="template/template/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="template/template/js/off-canvas.js"></script>
  <script src="template/template/js/hoverable-collapse.js"></script>
  <script src="template/template/js/template.js"></script>
  <script src="template/template/js/settings.js"></script>
  <script src="template/template/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
