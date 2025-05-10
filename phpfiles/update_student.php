<?php
include("conn.php");

$target_dir = "../upload/";

$id=$_REQUEST['sid'];
$sql_s="select * from students where stud_id='$id'";
$res_s=$con->query($sql_s);
$row_s=$res_s->fetch_assoc();

if(isset($_POST['add'])){

    $admission_no=$_REQUEST['admission_no'];
	$roll_no=$_REQUEST['roll_no'];
	$name=$_REQUEST['name'];
	$phone=$_REQUEST['phone'];
	$address=$_REQUEST['address'];
	$address1=$_REQUEST['address1'];
	$dob=$_REQUEST['dob'];
	
	/*$sql1="select max(userid) as id from login";
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
	{*/
	
	if (!empty($_FILES['photo']['name']))
		{
		
		$target_file = $target_dir . basename($_FILES["photo"]["name"]);
	
		move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
		
			$sql="update students set admission_no='$admission_no', name='$name', roll_no='$roll_no', phone='$phone', address='$address', current_address='$address1', dob='$dob', photo='$target_file' where stud_id=$id";
		}
		else
		{
			$sql="update students set admission_no='$admission_no', name='$name', roll_no='$roll_no', phone='$phone', address='$address', current_address='$address1',dob='$dob' where stud_id=$id";
		}
	$sql2="update login set username='$admission_no' , password='$phone' where userid=$id";
	$result2=$con->query($sql2);
	
	$result=$con->query($sql);
	$count=$con->affected_rows;
	if($count>0)
	{
		echo "<script>alert('Student Details Updated');</script>";
	}
	else
	{
		echo "<script>alert('Something went wrong'!);</script>";
	}
//}
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
                  <h4 class="card-title">Update Student Details</h4>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                  <!--<div class="form-group">
                      <label for="exampleSelectGender">Select Department</label>
                        <select class="form-control" id="exampleSelectGender" name="dep_id" required onChange="this.form.submit()">
                        <option value="">-Select-</option>
                          <?php
						  /*$sql="select * from department";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['dept_id']==$_REQUEST['dep_id'])
						  {*/
						  ?>
                        <option selected value="<?php // echo $row['dept_id']; ?>"><?php  //echo $row['department']; ?></option>
                        <?php
						//}else {
						?>
                        <option value="<?php // echo $row['dept_id']; ?>"><?php // echo $row['department']; ?></option>
                          <?php
						  //}
						  //}
						?>
                        </select>
                      </div>-->
                      <?php
					  //if(isset($_REQUEST['dep_id']))
					  //{
					  ?>
                      <!--<div class="form-group">
                      <label for="exampleSelectGender">Select Batch</label>
                        <select name="batch_id" class="form-control" id="exampleSelectGender">
                        <option>-Select-</option>
                         <?php
						 /*$did=$_REQUEST['dep_id'];
						  $sql="select * from batches where did='$did'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {*/
						  ?>
                       <option value="<?php // echo $row['batch_id']; ?>"><?php // echo $row['batch_name']; ?></option>
                          <?php
						  //}
						  ?>
                        </select>
                      </div>-->
                      <?php
					  //}
					  ?>
                <div class="form-group">
                      <label for="exampleInputName1">Admission Number</label>
                      <input name="admission_no" type="text" class="form-control" id="exampleInputName1" placeholder="AJS001" value="<?php echo $row_s['admission_no']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Name</label>
                      <input name="name" type="text" class="form-control" id="exampleInputName1" placeholder="Name"  value="<?php echo $row_s['name']; ?>">
                    </div>
                      <div class="form-group">
                      <label for="exampleInputName1">Roll Number</label>
                      <input name="roll_no" type="text" class="form-control" id="exampleInputName1" placeholder=""  value="<?php echo $row_s['roll_no']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Date of Birth</label>
                      <input name="dob" type="date" class="form-control" id="exampleInputName1" placeholder=""  value="<?php echo $row_s['dob']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Phone</label>
                      <input name="phone" type="text" class="form-control" id="exampleInputName1" placeholder=""  value="<?php echo $row_s['phone']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Permanent Address</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="address"><?php echo $row_s['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Current Address</label>
                      <textarea class="form-control" id="exampleTextarea1" rows="4" name="address1"><?php echo $row_s['current_address']; ?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Upload Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control" />
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
