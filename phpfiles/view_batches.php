<?php
include("conn.php");

if(isset($_REQUEST['update']))
{
	$sem=$_REQUEST['sem'];
	/*if(array_search("",$sem))
	{
		echo "Enter all the fields";
	}
	else
	{*/
		$bid=$_REQUEST['bid'];
		for($s=0;$s<count($bid);$s++)
		{	
			$sql1="update batches set current_sem='$sem[$s]' where batch_id='$bid[$s]'";
			$result1=$con->query($sql1);
		//}
		}
	if($result1)
	{
		echo "<script> alert('Semester details updated!'); </script>";
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Attendance Management System</title>
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
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <img src="../New folder/logo.png" width="200">
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

<div class="content-wrapper">
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Batches</h4>
                  <form class="forms-sample" method="post">
                  <div class="row">
                    <div class="col-sm-10">
                      <label for="exampleSelectGender">Select Department</label>
                        <select class="form-control" id="exampleSelectGender" name="department" required>
                        <option value="">-Select-</option>
                          <?php
						  $sql="select * from department";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['dept_id']==$_REQUEST['department'])
						  {
						  ?>
                          	<option value="<?php echo $row['dept_id']; ?>" selected><?php echo $row['department']; ?></option>
                          <?php
						  }
						  else
						  {
						  ?>
                          	<option value="<?php echo $row['dept_id']; ?>"><?php echo $row['department']; ?></option>
                          <?php
						  }
						  }
						  ?>
                        </select>
                        
                      </div>
                      <div class="col-sm-2">
                    	<input type="submit" value="View Details" name="enter" class="btn btn-primary mr-2" style="margin-top:29px; padding-top:15px; padding-bottom:15px;">
                        
                      </div>
                      </div>
                      </form>
                      <?php
					  if(isset($_POST['enter']))
					  {
					  	$department=$_REQUEST['department'];
						$sql="select * from batches where did='$department'";
						$result=$con->query($sql);
						
					  ?>
                  <div class="table-responsive pt-3">
                  <form method="post">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Batch Name</th>
                          <th>&nbsp;</th>
                          <th>Enter New Semester</th>
                          <!--<th></th>-->
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  $i=1;
					  while($row=$result->fetch_assoc())
					  {
					  ?>
                        <tr>
                          <td><?php echo $i; ?></td>
                          <td><?php echo $row['batch_name']; ?><input type="hidden" name="bid[]" value="<?php echo $row['batch_id']; ?>"></td>
                          <td><a href="adminhome.php?disp=view_subjects&did=<?php echo $row['did']; ?>">view subjects</a></td>
                          <td><input type="text" name="sem[]" value="<?php echo $row['current_sem']; ?>" required></td>
                        </tr>
                        <?php
						$i++;
					  }
					  ?>
                        <tr>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td><input type="submit" name="update" id="button" value="Update Semester"></td>
                        </tr>
                      </tbody>
                    </table>
                    </form>
</div>
<?php }
?>
</div>
</div>
</div>
</div>
</div>
                
</body>
</html>
