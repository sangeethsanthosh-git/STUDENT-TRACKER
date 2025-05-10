<?php
include("conn.php");
if(isset($_POST['add'])){

    $department=$_REQUEST['department'];
	$sem=$_REQUEST['sem'];
	$subject_title=$_REQUEST['subject'];
	$type=$_REQUEST['type'];

$sql="insert into subjects (dept_id, semester, subject_title,type) values('$department','$sem','$subject_title','$type')";

$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0){
    echo "<script>alert('New Subject added');</script>";
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
                  <h4 class="card-title">New Subject</h4>
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleSelectGender">Select Department</label>
                        <select class="form-control" id="exampleSelectGender" name="department" required>
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
                      <label for="exampleInputName1">Choose Semester</label>
                      <select class="form-control" id="exampleSelectGender" name="sem" required>
                        <option value="">-Select-</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        </select>
                    </div>
                    
                      <div class="form-group">
                        <label for="label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                          <option value="">-Select-</option>
                          <option>Theory</option>
                          <option>Lab</option>
                        </select>
                      </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Subject</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="subject" placeholder="Subject title" required>
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
