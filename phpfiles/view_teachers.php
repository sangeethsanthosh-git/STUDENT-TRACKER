<?php
include("conn.php");
if(isset($_REQUEST['uid']))
{
	$uid=$_REQUEST['uid'];
	$sql1="update teachers set status='1' where emp_id='$uid'";
	$sql2="update login set status='1' where userid='$uid'";
	$result1=$con->query($sql1);
	$result2=$con->query($sql2);
	if($result1&& $result2)
	{
		echo "<script> alert('Record Deleted!'); </script>";
		echo "<script> window.location.href='adminhome.php?disp=view_teachers'</script>";
	}
	else
	{
		echo "<script> alert('Failed!'); </script>";
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
                  <h4 class="card-title">Our Teachers</h4>
                 
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th width="107">Staff Code</th>
                          <th width="61">Name</th>
                          <th width="75">Department</th>
                          <th width="96">Phone Number</th>
                          <th width="96">Address</th>
                          <th width="96"></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
					  $stud_sql="select * from teachers where status='0'";
					  $res_stud=$con->query($stud_sql);
					  while($row_stud=$res_stud->fetch_assoc())
					  {
					  ?>
                        <tr><td><?php echo $row_stud['staff_code']; ?></td>
                          <td><?php echo $row_stud['name']; ?></td>
                          <td>
						  <?php
						  $did=$row_stud['dep_id'];
						  $sql="SELECT * FROM department where dept_id='$did'";
						  $res=$con->query($sql);
						  $row=$res->fetch_assoc();
						  echo $row['department'];
						   ?>                           </td>
                          <td><?php echo $row_stud['phone']; ?></td>
                          <td><?php echo $row_stud['address']; ?></td>
                          <td>
                          <a href="adminhome.php?disp=view_teachers&uid=<?php echo $row_stud['emp_id']; ?>">remove</a> /
                          <a href="adminhome.php?disp=update_teacher&uid=<?php echo $row_stud['emp_id']; ?>">edit</a> 
                          </td>
                        </tr>
                        <?php
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