<?php
include("conn.php");
$user=$_SESSION['uid'];
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
                  
                      <?php
						$sql="select * from subject_assigned where teach_id='$user'";
						$result=$con->query($sql);
						
					  ?>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Batch Name</th>
                          <th>Subject</th>
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
                          <td><?php 
						  $b_id=$row['batch_id'];
						  $sql1="select * from batches where batch_id='$b_id'";
						  $result1=$con->query($sql1);
						  $row1=$result1->fetch_assoc();
						  echo $row1['batch_name']." (Semester ".$row1['current_sem'].")"; 
						  ?>                          </td>
                          <td>
						  <?php 
						  $sub_id=$row['sub_id'];
						  $sql2="select * from subjects where id='$sub_id'";
						  $result2=$con->query($sql2);
						  $row2=$result2->fetch_assoc();
						  echo $row2['subject_title'];  
						  ?>                          </td>
                        </tr>
                        <?php
						$i++;
						}
						?>
                      </tbody>
                    </table>
</div>
</div>
</div>
</div>
</div>
</div>
                
</body>
</html>
