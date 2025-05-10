<?php
class book
 {
  function book()
   {
   	switch($_REQUEST['disp'])
		
	{
			case'form':
		  	include_once("form.php");
		  	break;
			case'add_dept':
		  	include_once("add_dept.php");
		  	break;
			case'add_batch':
		  	include_once("add_batch.php");
		  	break;
			case'add_teach':
			include_once("new_teacher.php");
		  	break;
			case'new_student':
			include_once("new_student.php");
		  	break;
			case'add_subject':
			include_once("add_subjects.php");
		  	break;
			case'assign':
			include_once("assign_sub.php");
		  	break;
			case'view_schedule':
			include_once("view_schedule.php");
		  	break;
			case'view_students':
			include_once("view_students.php");
		  	break;
			case'class_schedule':
			include_once("class_schedule.php");
		  	break;
			case'stud_teach':
			include_once("view_students_teacher.php");
		  	break;
			case'take_attendance':
			include_once("take_attendance.php");
		  	break;
			case'view_teachers':
			include_once("view_teachers.php");
		  	break;
			case'addmarks':
			include_once("add_marks.php");
		  	break;
			case'perf':
			include_once("performance.php");
		  	break;
			case'view_students_teach':
			include_once("view_students_teacher.php");
		  	break;
			case'list':
			include_once("student_list.php");
		  	break;
			case'view_attendance':
			include_once("view_attendance.php");
		  	break;
			case'update_schedule':
			include_once("update_schedule.php");
		  	break;
			case'update_student':
			include_once("update_student.php");
		  	break;
			case'update_teacher':
			include_once("update_teacher.php");
		  	break;
			case'view_batches':
			include_once("view_batches.php");
		  	break;
			case'view_subjects':
			include_once("view_subjects.php");
		  	break;
			case'edit_subjects':
			include_once("edit_subjects.php");
		  	break;
			
			
		/*case'log': echo "<script>alert('Please login')</script>";
					$mode=$_REQUEST['mode'];
					echo "<script>window.location='index.php?disp=login&mode=$mode'</script>";
					break;
			
		*/
			
		
			
		
		}
	}   
 }	



?>