<?php
include("conn.php");
$user=$_SESSION['uid'];

/***department***/
$d="select * from teachers where emp_id='$user'";
$d_res=$con->query($d);
$d_row=$d_res->fetch_assoc();
$did=$d_row['dep_id'];

if(isset($_REQUEST['update']))
{
	$sub=$_REQUEST['sub'];
	$batchid=$_REQUEST['batchid'];
	$date=$_REQUEST['date'];
	$period=$_REQUEST['period'];
	$students=$_REQUEST['students'];
	
	
	$sem_sql1="SELECT * FROM batches where batch_id='$batchid'";
	$sem_result1=$con->query($sem_sql1);
	$s1=$sem_result1->fetch_assoc();
	$sem1=$s1['current_sem'];
	
	@$status=$_REQUEST['status'];
	if(empty($status))
	{
		$status[0]=0;	
	}
	
	$res=array_intersect($status,$students);
	
	foreach($students as $st)
	{
		
			if(in_array($st, $status))
			{
				$attendance="present";
			}
			else
			{
				$attendance="absent";
			}
		
		$sql1="SELECT * FROM attendance where stud_id='$st' and period='$period' and sub_id='$sub' and teach_id='$user' and date='$date'";
		$result1=$con->query($sql1);
		$count=$result1->num_rows;
		
		if($count>0)
		{	
			$r=$result1->fetch_assoc();
			$id=$r['aid'];
			$sql="update attendance set status='$attendance' where aid=$id";
		}
		else
		{
			$sql="insert into attendance (stud_id, teach_id, period, date, status, sub_id, sem) values('$st','$user','$period','$date','$attendance','$sub','$sem1')";
		}
		
		$result=$con->query($sql);
		
	}
		$count1=$con->affected_rows;
		if($count1>0)
		{
    		echo "<script>alert('Attendance Updated');</script>";
		}
		else
		{
			echo "<script>alert('Something went wrong'!);</script>";

		}
	
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
<div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Mark Attendance</h4>
                  
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
                      <p></p>
                      
                      </form>
                      <?php
					  if(isset($_REQUEST['enter']))
					  {
					  ?>
                      <br>
                    <form name="form1" method="post" action="">
                    <input type="hidden" name="batchid" value="<?php echo $_REQUEST['batch_id'];?>">
                    <input type="hidden" name="sub" value="<?php echo $_REQUEST['subject'];?>">
                  <div class="row">
                      <div class="col-sm-5">
                      <label for="exampleSelectGender">Select Date</label>
                      <input name="date" type="date" class="form-control" id="exampleInputName1" required>
                      </div>
                      <!--max="<?php // echo date('Y-m-d'); ?>"-->
                      <div class="col-sm-5">
                      <?php
					  $p=array('1','2','3','4','5');
					  ?>
                      <label for="exampleSelectGender">Select Period</label>
                        <select class="form-control" id="exampleSelectGender" name="period" required>
                        <option value="">-Select-</option>
                        <?php
						foreach($p as $i)
						{
							if($i==$_POST['period'])
							{
								echo "<option value='$i' selected>$i</option>";
							}
							else
							{
								echo "<option value='$i'>$i</option>";
							}
						}
						?>
                        
                         </select>
                      </div>
                      
                      </div>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th width="60">Student</th>
                          <th width="107">Admn No</th>
                          <th width="61">Roll No</th>
                          <th width="75">Name</th>
                          <th width="96">Present</th>
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
                        <tr><td class="py-1"><img src="../upload/<?php echo $row_stud['photo']; ?>" alt="image"/></td>
                          <td><?php echo $row_stud['admission_no']; ?></td>
                          <td><?php echo $row_stud['roll_no']; ?></td>
                          <td><?php echo $row_stud['name']; ?></td>
                          <td>
                            <input type="checkbox" name="status[]" id="status[]" value="<?php echo $row_stud['stud_id']; ?>">
                            <input type="hidden" name="students[]" value="<?php echo $row_stud['stud_id']; ?>">
                          </td>
                        </tr>
                        <?php
						}
						?>
                      </tbody>
                    </table>
                    <p align="right"><input name="update" type="submit" id="update" value="Update Attendance" class="btn btn-primary mr-2"></p>
                  </div>
                  </form>
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