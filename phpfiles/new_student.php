<?php
include("conn.php");

$target_dir = "../upload/";

if(isset($_POST['add'])){

    $admission_no=$_REQUEST['admission_no'];
	$batch_id=$_REQUEST['batch_id'];
	$dept_id=$_REQUEST['dep_id'];
	$roll_no=$_REQUEST['roll_no'];
	$name=$_REQUEST['name'];
	$phone=$_REQUEST['phone'];
	$address=$_REQUEST['address'];
	$address1=$_REQUEST['address1'];
	$dob=$_REQUEST['dob'];
	
	$sql1="select max(userid) as id from login";
	$res=$con->query($sql1);
	$row_id=$res->fetch_assoc();
	$max_id=$row_id['id'];
	$max_id++;
	
	$sql_check="select * from login where username='$admission_no'";
$result_check=$con->query($sql_check);
$count_check=$result_check->num_rows;
if ($count_check>0) 
{
	
	echo "<script>alert('Admission Number already exists!');</script>";

}
else
{
	$target_file = $target_dir . basename($_FILES["photo"]["name"]);

	move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);


$sql="insert into students (stud_id,admission_no,dept_id,batch_id,roll_no,name,phone,address,current_address,dob,photo,status) values('$max_id','$admission_no','$dept_id','$batch_id','$roll_no','$name','$phone','$address','$address1','$dob','$target_file','0')";

$sql2="insert into login (userid,username, password, type, status) values('$max_id','$admission_no','$phone','student','0')";
	
$result2=$con->query($sql2);

$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0)
{
    echo "<script>alert('New Students Added');</script>";
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
</head>
<body>
<div class="content-wrapper">
<div class="row">
<div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">New Student</h4>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                      <label for="exampleSelectGender">Select Department</label>
                        <select class="form-control" id="exampleSelectGender" name="dep_id" required onChange="this.form.submit()">
                        <option value="">-Select-</option>
                          <?php
						  $sql="select * from department";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['dept_id']==$_REQUEST['dep_id'])
						  {
						  ?>
                        <option selected value="<?php echo $row['dept_id']; ?>"><?php echo $row['department']; ?></option>
                        <?php
						}else {
						?>
                        <option value="<?php echo $row['dept_id']; ?>"><?php echo $row['department']; ?></option>
                          <?php
						  }
						  }
						  ?>
                        </select>
                      </div>
                      <?php
					  if(isset($_REQUEST['dep_id']))
					  {
					  ?>
                      <div class="form-group">
                      <label for="exampleSelectGender">Select Batch</label>
                        <select name="batch_id" class="form-control" id="exampleSelectGender" required>
                        <option value="">-Select-</option>
                         <?php
						 $did=$_REQUEST['dep_id'];
						  $sql="select * from batches where did='$did'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  ?>
                       <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']; ?></option>
                          <?php
						  }
						  ?>
                        </select>
                      </div>
                      <?php
					  }
					  ?>
                <div class="form-group">
                      <label for="exampleInputName1">Admission Number</label>
                      <input name="admission_no" type="text" class="form-control" id="exampleInputName1" placeholder="AJS001" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Name" required>
                    </div>
                      <div class="form-group">
                      <label for="exampleInputName1">Roll Number</label>
                      <input name="roll_no" type="text" class="form-control" id="exampleInputName1" placeholder="" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Date of Birth</label>
                      <input name="dob" type="date" class="form-control" id="exampleInputName1" placeholder="" required min="1988-01-01" max="2005-01-01">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Phone</label>
                      <input name="phone" type="text" class="form-control" id="exampleInputName1" placeholder="" required maxlength="10">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Permanent Address</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="address" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Current Address</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="address1" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Upload Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control"  required accept="image/*"/>
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
