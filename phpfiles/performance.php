<?php
include("conn.php");
$flag=0;
$user_type=$_REQUEST['ut'];
if($user_type=='admin')
{
	$user=$_REQUEST['uid'];
}
if($user_type=='stud')
{
	$user=$_SESSION['uid'];
}
$sql="SELECT * FROM subjects where dept_id in (select did from batches where batch_id in (select batch_id from students where stud_id='$user'))";
$res=$con->query($sql);

while($row=$res->fetch_assoc())
{
	$sub=$row['id'];

		$a_sql="select count(DISTINCT(date)) as days from attendance where sub_id='$sub'";
		$a_res=$con->query($a_sql);
		$a=$a_res->fetch_assoc();

	
	$a_s="select * from attendance where sub_id='$sub' and stud_id='$user' and status='present'";
	$a_r=$con->query($a_s);
	$stud_a=$a_r->num_rows;
	if($a['days']!=0)
	{
		$p=ceil(($stud_a*100)/$a['days']);
	}
	else
	{
		$p=0;
	}

	
	$dataPoints1[] = array(
    "y" => $p,
    "label" => $row['subject_title']
  );
}


/*$dataPoints = array( 
	array("y" => 44, "label" => "Mathematics" ),
	array("y" => 44, "label" => "Computer Fundamentals and Programming in C" ),
	array("y" => 44, "label" => "Digital Electronics" ),
	array("y" => 44, "label" => "Value Education" ),
	array("y" => 44, "label" => "C Programming Lab" ),
	array("y" => 44, "label" => "Digital Electronics Lab" )
);*/


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script>
window.onload = function() {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Attendance"
	},
	axisY: {
		title: "Present (in %)"
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## percentage",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
</head>
<body>
<div class="content-wrapper">
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Performance</h4>
                  <div class="row">
                  <div class="col-sm-6" id="chartContainer" style="height: 370px; width: 40%;"></div>
                    <div class="col-sm-6">
                    <?php
					$student="select * from students where stud_id='$user'";
					$student_res=$con->query($student);
					$s=$student_res->fetch_assoc();
					?>
                    <h3>Student Profile</h3>
                      <table width="459" border="1" cellpadding="5" cellspacing="0">
                        <tr>
                          <td width="106" rowspan="4"><img src="<?php echo $s['photo']; ?>" width="100"></td>
                          <td width="148">Admission Number</td>
                          <td width="167"><?php echo $s['admission_no']; ?></td>
                        </tr>
                        <tr>
                          <td>Department name</td>
                          <td><?php
						  $dept=$s['dept_id'];
						  $dept_sql="SELECT * FROM `department` where dept_id='$dept'";
						  $d_res=$con->query($dept_sql);
						  $d=$d_res->fetch_assoc();
						  echo $d['department'];
                          ?></td>
                        </tr>
                        <tr>
                          <td>Batch Name</td>
                          <td>
                          <?php
						  $batch_id=$s['batch_id'];
						  $batch_sql="SELECT * FROM batches where batch_id='$batch_id'";
						  $batch_res=$con->query($batch_sql);
						  $b=$batch_res->fetch_assoc();
						  echo $b['batch_name'];
                          ?>
                          </td>
                        </tr>
                        <tr>
                          <td>Date of Birth</td>
                          <td><?php echo $s['dob']; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo $s['name']; ?></td>
                          <td>Phone Number</td>
                          <td><?php echo $s['phone']; ?></td>
                        </tr>
                        <tr>
                          <td>Roll No : <?php echo $s['roll_no']; ?></td>
                          <td>Address</td>
                          <td><?php echo $s['address']; ?></td>
                        </tr>
                      </table>
                    </div>  
                  <div class="table-responsive pt-3">
                  <div class="row" style="margin-bottom:15px; margin-right:10px;">
                  <div class="col-sm-6">
                  <h3><u>Internal Mark Details</u></h3>
                  </div>
                      <div class="col-sm-6">
                  <form method="post">
                  <label for="exampleSelectGender">Select Semester</label>
                        <select name="sem" class="form-control" id="exampleSelectGender" onChange="this.form.submit()" required>
                        <option value="">-Select-</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        </select>
                  </form>
                  </div>
                  </div>
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th rowspan="2">#</th>
                          <th rowspan="2">Subjects</th>
                          <th colspan="4" align="center">Internal Marks</th>
                        </tr>
                        <tr>
						  <th>Assignment</th>
                          <th>Seminar</th>
                          <th>Lab</th>
<!--                          <th>Percentage</th>
-->                        </tr>
                      </thead>
                      <tbody> 
                     <?php
					  $i=1;
					  @$semester=$_REQUEST['sem'];
					 $sql="SELECT * FROM subjects where semester='$semester' and dept_id in (select did from batches where batch_id in (select batch_id from students where stud_id='$user'))";
					$res=$con->query($sql);

					while($row=$res->fetch_assoc())
					{
					
						$sub=$row['id'];
						$type=$row['type'];
						$mark_sql="select * from marks where stud_id='$user' and sub_id='$sub'";
						$mark_res=$con->query($mark_sql);
						$count=$mark_res->num_rows;
						if($count>0)
						  {
						  	$m=$mark_res->fetch_assoc();
						  }
						  else
						  {
						  $flag=1;
						  	$m['assignment']="Not Updated";
							$m['seminar']="Not Updated";
							$m['lab']="Not Updated";
						  }
					
					  ?>
                    	<tr>
                        <td><?php  echo $i; ?></td>
                        <td><?php  echo $row['subject_title']; ?></td>
                        <td><?php echo $m['assignment']; ?></td>
                        <td><?php echo $m['seminar']; ?></td>
                        <td><?php echo $m['lab']; ?></td>
                        <!--<td>
                        <?php
						/*if($flag!=1)
						{
							$sum=$m['assignment']+$m['seminar']+$m['lab'];
							$marks_per=((($sum/4)*10)/100)*80;
							echo $marks_per." %";
						}*/
						?>
                        </td>-->
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
</div>
<script src="../New folder/canvasjs.min.js"></script>
</body>
</html>
