<?php
include("conn.php");
$user=$_SESSION['uid'];

/***department***/
$d="select * from teachers where emp_id='$user'";
$d_res=$con->query($d);
$d_row=$d_res->fetch_assoc();
$did=$d_row['dep_id'];
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
                  <h4 class="card-title">Students Details</h4>
                  
                  <form class="forms-sample" method="post">
                  <div class="row">
                      <div class="col-sm-10">
                      <label for="exampleSelectGender">Select Batch</label>
                        <select name="batch_id" class="form-control" id="exampleSelectGender" required>
                        <option value="">-Select-</option>
                         <?php
						  $sql="select * from batches where did='$did'";
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						  {
						  if($row['batch_id']==$_REQUEST['batch_id'])
						  {
						  ?>
                       <option selected value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']." (Semester".$row['current_sem'].")"; ?></option>
                          <?php
						  }
						  else
						  {
						  ?>
                       <option value="<?php echo $row['batch_id']; ?>"><?php echo $row['batch_name']." (Semester".$row['current_sem'].")"; ?></option>
                          <?php
						  }
						  
						  }
						  ?>
                        </select>
                        
                      </div>
                      <div class="col-sm-2">
                      <label for="exampleSelectGender"></label>
                    	<input type="submit" value="View Students" name="enter" class="btn btn-primary mr-2" style="margin-top:8px; padding-top:15px; padding-bottom:15px;">
                      </div>
                      </div>
                      </form>
                      <?php
					  if(isset($_REQUEST['enter']))
					  {
					  	
					  ?>
                      <br>
                  <?php
					  $batch=$_REQUEST['batch_id'];
					  $stud_b="SELECT * FROM `batches` where batch_id='$batch'";
					  $res_b=$con->query($stud_b);
					  $row_b=$res_b->fetch_assoc();
                      ?>
                  <h4 style="color:#0033CC">Semester <?php echo $row_b['current_sem']; ?></h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th width="60">&nbsp;</th>
                          <th width="60">Student</th>
                          <th width="107">Admn No</th>
                          <th width="61">Roll No</th>
                          <th width="75">Name</th>
                          <th width="96">Date of Birth</th>
                          <th width="96">Phone Number</th>
                          <th width="96">Permanent Address</th>
                          <th width="96">Current Address</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  $batch=$_REQUEST['batch_id'];
					  $stud_sql="select * from students where dept_id='$did' and batch_id='$batch'";
					  $res_stud=$con->query($stud_sql);
					  while($row_stud=$res_stud->fetch_assoc())
					  {
					  ?>
                        <tr>
                          <td class="py-1"><a href="staffhome.php?disp=perf&uid=<?php echo $row_stud['stud_id']; ?>&ut=admin">view</a>
</td>
                          <td class="py-1"><img src="../upload/<?php echo $row_stud['photo']; ?>" alt="image"/></td>
                          <td><?php echo $row_stud['admission_no']; ?></td>
                          <td><?php echo $row_stud['roll_no']; ?></td>
                          <td><?php echo $row_stud['name']; ?></td>
                          <td><?php echo $row_stud['dob']; ?></td>
                          <td><?php echo $row_stud['phone']; ?></td>
                          <td><?php echo $row_stud['address']; ?></td>
                          <td><?php echo $row_stud['current_address']; ?></td>
                        </tr>
                        <?php
						}
						?>
                      </tbody>
                    </table>
                  </div>
                  <?php
				  }
				  ?>
                </div>
              </div>
            </div>
 </div>
</div>
</body>
</html> 