<?php
include("conn.php");
if(isset($_POST['add'])){

    $department=$_REQUEST['department'];
	$sem=$_REQUEST['sem'];
	$subject_title=$_REQUEST['subject'];
	$teacher=$_REQUEST['teacher'];
	$batch_id=$_REQUEST['batch_id'];

$sql="insert into subject_assigned (dept_id, batch_id, sem, teach_id, sub_id) values('$department','$batch_id','$sem','$teacher','$subject_title')";

$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0){
    echo "<script>alert('One Subject assigned to teacher');</script>";
}
else
{
	echo "<script>alert('Something went wrong'!);</script>";}

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
                  <h4 class="card-title">Assign Subject</h4>
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleSelectGender">Select Department</label>
                        <select class="form-control" id="exampleSelectGender" name="department" required onChange="this.form.submit()">
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
                      <div class="form-group">
                      <label for="exampleSelectGender">Select Teachers</label>
                        <select class="form-control" id="exampleSelectGender" name="teacher" required onChange="this.form.submit()">
                        <option value="">-Select-</option>
                          <?php
						  $id=$_REQUEST['department'];
						  $sql="select * from teachers where dep_id='$id' and status='0'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['emp_id']==$_REQUEST['teacher'])
						  {
						  ?>
                          	<option value="<?php echo $row['emp_id']; ?>" selected><?php echo $row['name']; ?></option>
                          <?php
						  }
						  else
						  {
						  ?>
                          	<option value="<?php echo $row['emp_id']; ?>"><?php echo $row['name']; ?></option>
                          <?php
						  }
						  }
						  ?>
                        </select>
                      </div>
                       <?php
					  if(isset($_REQUEST['department']))
					  {
					  ?>
                      <div class="form-group">
                      <label for="exampleSelectGender">Select Batch</label>
                        <select name="batch_id" class="form-control" id="exampleSelectGender" onChange="this.form.submit()" required>
                        <option value="">-Select-</option>
                         <?php
						 
						 $did=$_REQUEST['department'];
						  $sql="select * from batches where did='$did'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['batch_id']==$_REQUEST['batch_id'])
						  {
						  ?>
                       <option selected value="<?php echo $row['batch_id']; ?>">
					   <?php echo $row['batch_name']."(Semester ".$row['current_sem'].")"; ?>
                       </option>
                          <?php
						  }
						  else
						  {
						  ?>
                       <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']."(Semester ".$row['current_sem'].")"; ?></option>
                          <?php
						  }
						  
						  }
						  ?>
                        </select>
                      </div>
                      <?php
					  }
					  ?>
                     
                    <?php
					if(isset($_REQUEST['department'])&& (@$_REQUEST['batch_id']))
					{
						$batchid=$_REQUEST['batch_id'];
						$sql_s="select * from batches where batch_id='$batchid'";
						$result_s=$con->query($sql_s);
						$row_s=$result_s->fetch_assoc();
					?>
                    <input type="hidden" value="<?php echo $row_s['current_sem']; ?>" name="sem">
                      <div class="form-group">
                      <label for="exampleInputName1">Subject</label>
                      <select class="form-control" id="exampleSelectGender" name="subject" required>
                        <option value="">-Select-</option>
                       <?php
					   	$sem=$row_s['current_sem'];
						$department=$_REQUEST['department'];
						$batch_id=$_REQUEST['batch_id'];
						
						  $sql="select * from subjects where semester='$sem' and dept_id='$department' and id not in (select sub_id from subject_assigned where dept_id='$department' and batch_id='$batch_id' and sem='$sem')";
						  
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						    {
							?>
                                <option value=<?php echo $row['id']; ?>><?php echo $row['subject_title']; ?></option>
                           <?php
							}
						  ?>
                         </select> 
                    </div>
                     <?php } ?>
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
