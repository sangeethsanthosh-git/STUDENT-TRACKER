<?php
include("conn.php");
$user=$_SESSION['uid'];

/***department***/
$d="select * from teachers where emp_id='$user'";
$d_res=$con->query($d);
$d_row=$d_res->fetch_assoc();
$did=$d_row['dep_id'];

if(isset($_REQUEST['add']))
{
	$subject=$_REQUEST['subject'];
	$batch_id=$_REQUEST['batch_id'];
	$date=$_REQUEST['date'];
	$student=$_REQUEST['student'];
	$mark_a=$_REQUEST['mark_a'];
	$mark_s=$_REQUEST['mark_s'];
	$mark_l=$_REQUEST['mark_l'];
	
	$sem_sql1="SELECT * FROM batches where batch_id='$batch_id'";
	$sem_result1=$con->query($sem_sql1);
	$s1=$sem_result1->fetch_assoc();
	$sem1=$s1['current_sem'];
	
		
		$sql1="SELECT * FROM subjects where id='$subject'";
		$result1=$con->query($sql1);
		$row1=$result1->fetch_assoc();
		$type=$row1['type'];	
		
			$sql="insert into marks (stud_id, sub_id, type, assignment, seminar, lab, date, sem) values('$student','$subject','$type','$mark_a','$mark_s','$mark_l','$date','$sem1')";
		
		$result=$con->query($sql);
		
	
		$count1=$con->affected_rows;
		if($count1>0)
		{
    		echo "<script>alert('Marks Updated');</script>";
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
                  <h4 class="card-title">Mark Details</h4>
                  <form class="forms-sample" method="post" enctype="multipart/form-data">
                  <div class="form-group">
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
                      <div class="form-group">
                      <label for="exampleSelectGender">Select Subject</label>
                        <select class="form-control" id="exampleSelectGender" name="subject" required onChange="this.form.submit()">
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
                      <div class="form-group">
                      <label for="exampleSelectGender">Select Student</label>
                       <select class="form-control" id="exampleSelectGender" name="student" required>
                        <option value="">-Select-</option>
                        <?php
					  $batch=$_REQUEST['batch_id'];
					   
					  $sub1=$_REQUEST['subject'];

					  $stud_sql="select * from students where dept_id='$did' and batch_id='$batch' and stud_id not in (select stud_id from marks where sub_id='$sub1')";
					  $res_stud=$con->query($stud_sql);
					  while($row_stud=$res_stud->fetch_assoc())
					  {
					  ?>
                      <option value="<?php echo $row_stud['stud_id']; ?>"><?php echo $row_stud['name']. " (Roll No : ".$row_stud['roll_no']." )"; ?></option>
                      <?php
					  }
					  ?>
                        
                         </select>
                      </div>
                <div class="form-group">
                      <label for="exampleInputName1">Assignment Mark out of 10</label>
                      <select name="mark_a" class="form-control" id="exampleSelectGender" required>
                        <option value="">-Select-</option>
                        <?php
						for($i=0; $i<=10;$i++)
						{
							echo "<option>$i</option>";
						}
						?>
                  </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Seminar Mark out of 10</label>
                      <select name="mark_s" class="form-control" id="exampleSelectGender" required>
                        <option value="">-Select-</option>
                        <?php
						for($i=0; $i<=10;$i++)
						{
							echo "<option>$i</option>";
						}
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Lab Performance mark out of 20</label>
                      <select name="mark_l" class="form-control" id="exampleSelectGender" required>
                        <option value="">-Select-</option>
                        <?php
						for($i=0; $i<=20;$i++)
						{
							echo "<option>$i</option>";
						}
						?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputName1">Choose Date</label>
                      <input name="date" type="date" class="form-control" id="exampleInputName1" placeholder="" required>
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