<?php
include("conn.php");

if(isset($_POST['add'])){

    $department=$_REQUEST['department'];

$sql="insert into department (department) values('$department')";

$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0){
    echo "<script>alert('New Department Added');</script>";
}
else{
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
                  <h4 class="card-title">New Department</h4>
                  <form class="forms-sample" method="post">
                    <div class="form-group">
                      <label for="exampleInputName1">Department Name</label>
                      <input name="department" type="text" class="form-control" id="exampleInputName1" placeholder="" required>
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
