<?php
include("conn.php");
if(isset($_POST['add'])){

    $department=$_REQUEST['department'];
	$batch=$_REQUEST['batch'];
	$year=$_REQUEST['year'];

$sql="insert into batches (did, batch_name, current_sem, year) values('$department','$batch','1','$year')";

$result=$con->query($sql);
$count=$con->affected_rows;
if($count>0){
    echo "<script>alert('New Batch Added');</script>";
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
                  <h4 class="card-title">New Batch</h4>
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
                      <label for="exampleInputName1">Batch Name</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="batch" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Batch Starting Year</label>
                      <input type="text" class="form-control" id="exampleInputName1" name="year" placeholder="Name" required>
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
