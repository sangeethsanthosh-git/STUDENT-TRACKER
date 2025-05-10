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
                  <h4 class="card-title">Attendance List</h4>
                  
                  <form class="forms-sample" method="post">
                  <div class="row">
                      <div class="col-sm-5">
                      <label for="exampleSelectGender">Select Batch</label>
                        <select name="batch_id" class="form-control" id="exampleSelectGender" onChange="this.form.submit()" required>
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
                      <div class="col-sm-5">
                      <label for="exampleSelectGender">Select Subject</label>
                        <select class="form-control" id="exampleSelectGender" name="subject" required>
                        <option value="">-Select-</option>
                       <?php
						$batch_id=$_REQUEST['batch_id'];
						
						/*****sem*****/
						
						$sem_sql="SELECT * FROM batches where batch_id='$batch_id'";
						$sem_result=$con->query($sem_sql);
						$s=$sem_result->fetch_assoc();
						$sem=$s['current_sem'];
						
						
						  $sql="select * from subjects where semester='$sem' and dept_id='$did' and id not in(select sub_id from subject_assigned where teach_id='$user' and batch_id='$batch_id')";
						  
						  $result=$con->query($sql);
						  while($row=$result->fetch_assoc())
						    {
							if($_REQUEST['subject']==$row['id'])
							{
							?>
                                <option value=<?php echo $row['id']; ?> selected><?php echo $row['subject_title']; ?></option>
                           <?php
						   }
						   else
						   {
						   ?>
                                <option value=<?php echo $row['id']; ?>><?php echo $row['subject_title']; ?></option>
                           <?php
						   }
							}
						  ?>
                         </select>
                        
                      </div>
                      <div class="col-sm-2">
                      <label for="exampleSelectGender"></label>
                    	<input type="submit" value="ENTER" name="enter" class="btn btn-primary mr-2" style="margin-top:30px; padding-top:15px; padding-bottom:15px;">
                      </div>
                      </div>
                      </form>
                      <?php
					  if(isset($_REQUEST['enter']))
					  {
					  	
					  ?>
                     <br>
                  <h4 style="color:#0033CC">Semester 1</h4>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th width="60">Student</th>
                          <th width="107">Admn No</th>
                          <th width="61">Roll No</th>
                          <th width="75">Name</th>
                          <th width="96">Total Working days</th>
                          <th width="96">No of days present</th>
                          <th width="96">Attendance Percentage</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  $batch=$_REQUEST['batch_id'];
					  $sub=$_REQUEST['subject'];
					  
					  	$sem_sql="SELECT * FROM batches where batch_id='$batch_id'";
						$sem_result=$con->query($sem_sql);
						$s=$sem_result->fetch_assoc();
						$sem=$s['current_sem'];
					  
					  
					  
					  $a_sql="select count(DISTINCT(date)) as days from attendance where sub_id='$sub' and sem='$sem'";
					  $a_res=$con->query($a_sql);
					  $a=$a_res->fetch_assoc();
					  
					   
					  $stud_sql="select * from students where dept_id='$did' and batch_id='$batch'";
					  $res_stud=$con->query($stud_sql);
					  while($row_stud=$res_stud->fetch_assoc())
					  {
					  ?>
                        <tr><td class="py-1"><img src="../upload/<?php echo $row_stud['photo']; ?>" alt="image"/></td>
                          <td><?php echo $row_stud['admission_no']; ?></td>
                          <td><?php echo $row_stud['roll_no']; ?></td>
                          <td><?php echo $row_stud['name']; ?></td>
                          <?php
						  $s=$row_stud['stud_id'];
						  $mark_sql="select * from marks where stud_id='$s' and sub_id='$sub'";
						  $mark_res=$con->query($mark_sql);
						  $m=$mark_res->fetch_assoc();
						  ?>
                          <td style="color:#FF0000; font-weight:bolder;"><?php echo $a['days']; ?></td>
                          <?php
						  $a_s="select * from attendance where sub_id='$sub' and sem='$sem' and stud_id='$s' and status='present'";
					  	  $a_r=$con->query($a_s);
					  	  $stud_a=$a_r->num_rows;
						  if($a['days']!=0)
						  {$p=ceil(($stud_a*100)/$a['days']);} else {$p=0;}
						  ?>
                          
                          <td style="color:#FF0000; font-weight:bolder;"><?php echo $stud_a; ?></td>
                          <td style="color:#FF0000; font-weight:bolder;"><?php echo @$p." %"; ?></td>
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