<?php
include("conn.php");

$sid=$_REQUEST['sid'];
$sql="select * from subjects where id='$sid'";
$res=$con->query($sql);
$row=$res->fetch_assoc();

if(isset($_POST['add'])){

	$subject_title=$_REQUEST['subject'];
	$type=$_REQUEST['type'];
	$d=$_REQUEST['d'];

$sql="update subjects set subject_title='$subject_title', type='$type' where id='$sid'";
$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0){
    echo "<script>alert('Subject details updated');</script>";
	echo "<script type='text/javascript'> window.location.href='adminhome.php?disp=view_subjects&did=$d'; </script>";	
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
                  <h4 class="card-title">Update Subject details</h4>
                  <form class="forms-sample" method="post">
                    <!--<div class="form-group">
                      <label for="exampleSelectGender">Department</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="dept" placeholder="Name" disabled value="<?php // echo $row['dept_id']; ?>">
                      </div>-->
                      <input type="hidden" name="d" value="<?php  echo $row['dept_id']; ?>">
                      <div class="form-group">
                      <label for="exampleInputName1">Semester</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="sem" placeholder="Name" disabled value="<?php echo $row['semester']; ?>">
                    </div>
                    
                      <div class="form-group">
                        <label for="label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                          <option value="">-Select-</option>
                          <option <?php if($row['type']=='Theory'){echo "selected";} ?>>Theory</option>
                          <option <?php if($row['type']=='Lab'){echo "selected";} ?>>Lab</option>
                        </select>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Subject</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="subject" placeholder="Name" value="<?php echo $row['subject_title']; ?>">
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
