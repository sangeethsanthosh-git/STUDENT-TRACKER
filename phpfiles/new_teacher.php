<?php
include("conn.php");
if(isset($_POST['add'])){

    $staff_code=$_REQUEST['staff_code'];
	$name=$_REQUEST['name'];
	$dep_id=$_REQUEST['dep_id'];
	$phone=$_REQUEST['phone'];
	$address=$_REQUEST['address'];
	
	$sql1="select max(userid) as id from login";
	$res=$con->query($sql1);
	$row_id=$res->fetch_assoc();
	$max_id=$row_id['id'];
	$max_id++;
	
	$sql_check="select * from login where username='$staff_code'";
$result_check=$con->query($sql_check);
$count_check=$result_check->num_rows;
if ($count_check>0) 
{
	echo "<script>alert('Username already exists!');</script>";
}
	
else
{
	
	
	$sql="insert into teachers (emp_id,staff_code, name, dep_id, phone, address, status) values('$max_id','$staff_code','$name','$dep_id','$phone','$address','0')";
	
	$sql2="insert into login (userid,username, password, type, status) values('$max_id','$staff_code','$phone','teacher','0')";
	
	$result2=$con->query($sql2);
	
	$result=$con->query($sql);
	$count=$con->affected_rows;
		if($count>0)
		{
			echo "<script>alert('New Teacher Added');</script>";
		}
		else
		{
			echo "<script>alert('Something went wrong'!);</script>";
		}

}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
<div class="content-wrapper">
<div class="row">
<div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Teacher</h4>
                  <form class="forms-sample" method="post">
                  <div class="form-group">
                      <label for="exampleInputName1">Staff Code</label>
                      <input name="staff_code" type="text" class="form-control" id="exampleInputName1" placeholder="AJ001" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleSelectGender">Department Name</label>
                        <select class="form-control" id="exampleSelectGender" name="dep_id" required>
                        <option value="">-Select-</option>
                          <?php
						  $sql="select * from department";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  ?>
                          	<option value="<?php echo $row['dept_id']; ?>"><?php echo $row['department']; ?></option>
                          <?php
						  }
						  ?>
                        </select>
                      </div>
                      <div class="form-group">
                      <label for="exampleInputName1">Phone</label>
                      <input name="phone" type="text" class="form-control" id="exampleInputName1" placeholder="" required>
                    </div>
                    
                      <div class="form-group">
                      <label for="exampleTextarea1">Address</label>
                      <textarea name="address" rows="4" class="form-control" id="exampleTextarea1" required></textarea>
                    </div>
                    <input type="submit" value="Enter" name="add" class="btn btn-primary mr-2">
                    <input type="reset" value="Reset" class="btn btn-light">
                  </form>
                </div>
              </div>
            </div>
            </div>
            </div>
</body>
</html>
