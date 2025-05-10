<?php
include("conn.php");

$dept_id=$_REQUEST['did'];

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
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">View Subjects</h4>
                  <form class="forms-sample" method="post">
                  <div class="row">
                    <div class="col-sm-10">
                      <label for="exampleSelectGender">Select Semester</label>
                        <select class="form-control" id="exampleSelectGender" name="sem" required>
                        <option value="">-Select-</option>
                          <?php
						  $sql="select distinct semester from subjects where dept_id='$dept_id'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['semester']==$_REQUEST['sem'])
						  {
						  ?>
                          	<option selected><?php echo $row['semester']; ?></option>
                          <?php
						  }
						  else
						  {
						  ?>
                          	<option><?php echo $row['semester']; ?></option>
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
					  	$s=$_REQUEST['sem'];
						$sql="SELECT * FROM `subjects` where semester='$s' and dept_id='$dept_id'";
						$result=$con->query($sql);
						
					  ?>
                  <div class="table-responsive pt-3">
                  <form method="post">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Subject</th>
                          <th>Type</th>
                          <th>&nbsp;</th>
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
                          <td><?php echo $row['subject_title']; ?></td>
                          <td><?php echo $row['type']; ?></td>
                          <td><a href="adminhome.php?disp=edit_subjects&sid=<?php echo $row['id']; ?>">edit subject</a></td>
                        </tr>
                        <?php
						$i++;
					  }
					  ?>
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
