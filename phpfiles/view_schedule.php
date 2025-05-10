<?php
include("conn.php");

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
                  <h4 class="card-title">Class Schedule</h4>
                  <form class="forms-sample" method="post">
                  <div class="row">
                    <div class="col-sm-5">
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
                      <div class="col-sm-5">
                      <label for="exampleSelectGender">Select Batch</label>
                        <select name="batch_id" class="form-control" id="exampleSelectGender" required>
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
                       <option selected value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']."(Semester ".$row['current_sem'].")"; ?></option>
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
                      <div class="col-sm-2">
                      <label for="exampleSelectGender"></label>
                    	<input type="submit" value="View Schedule" name="enter" class="btn btn-primary mr-2" style="margin-top:8px; padding-top:15px; padding-bottom:15px;">
                      </div>
                      </div>
                     
                      </form>
                      <?php
					  if(isset($_POST['enter']))
					  {
					  	$department=$_REQUEST['department'];
						$batch_id=$_REQUEST['batch_id'];
						//$sem=$_REQUEST['sem'];
						$sql="select * from subject_assigned where dept_id='$department' and batch_id='$batch_id'";
						$result=$con->query($sql);
						
					  ?>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Subject</th>
                          <th>Assigned to</th>
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
                          <td>
						  <?php 
						  $sub_id=$row['sub_id'];
						  $sql2="select * from subjects where id='$sub_id'";
						  $result2=$con->query($sql2);
						  $row2=$result2->fetch_assoc();
						  echo $row2['subject_title'];  
						  ?>
                          </td>
                          <td>
						  <?php 
						  $emp_id=$row['teach_id'];
						  $sql1="select * from teachers where emp_id='$emp_id'";
						  $result1=$con->query($sql1);
						  $row1=$result1->fetch_assoc();
						  if($row1['status']=='1')
						  {
						  	echo "<span style='color:red'>".$row1['name']."</span>";
						  }
						  else
						  {
						  	echo $row1['name']; 
						  }
						  ?>
                          </td>
                          <td><a href="adminhome.php?disp=update_schedule&id=<?php echo $row['id']; ?>">Change</a></td>
                        </tr>
                        <?php
						$i++;
						}
						?>
                      </tbody>
                    </table>
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
