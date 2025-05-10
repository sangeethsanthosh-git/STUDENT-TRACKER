<?php
include("conn.php");

$id=$_REQUEST['id'];
$sql1="SELECT * FROM subject_assigned where id='$id'";
$res1=$con->query($sql1);
$row1=$res1->fetch_assoc();
$department=$row1['dept_id'];


if(isset($_POST['add'])){

	$teacher=$_REQUEST['teacher'];

$sql="update subject_assigned set teach_id='$teacher' where id='$id'";
$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0){
    echo "<script>alert('Subject assigned');</script>";
	echo "<script type='text/javascript'> window.location.href='adminhome.php?disp=view_schedule'; </script>";
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
                  <h4 class="card-title">Assign class</h4>
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleSelectGender">Select Teachers</label>
                        <select class="form-control" id="exampleSelectGender" name="teacher" required>
                        <option value="">-Select-</option>
                          <?php
						  $sql="select * from teachers where dep_id='$department' and status='0'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  ?>
                          	<option value="<?php echo $row['emp_id']; ?>"><?php echo $row['name']; ?></option>
                          <?php
						  }
						  ?>
                        </select>
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
