<?php
  include_once("settings.php");
  $msg="";$_studarr=array(); $studres=array();
  if(isset($_POST['submit']))
  {
	  $_studarr['student_id']=$_POST['student_id'];
	  $_studarr['student_name']=$_POST['student_name'];
	  $_studarr['dob']=$_POST['dob'];
	  $studres=$studobj->existsStudent($_studarr['student_id']);
	  if(count($studres)>0)
	  {
		  $msg="<div class='alert alert-danger text-center' role='alert'>Student ID already exists</div>";
	  }
	  else
	  {
	  $studobj->insertStudent($_studarr);
	  $msg="<div class='alert alert-success text-center' role='alert'>Submitted Successfully</div>";
	  }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Registration</title>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css"/>
</head>
<body>
    <div class="container">     
        <?php include('menu.php');?>
        <div class="row">
       
            <div class="col-md-9">
                <?php if($msg!=""){?>
                 <?php echo $msg;?>
               <?php }?>
                <form name="stud_registration" action="<?php $_SERVER['PHP_SELF'];?>" method="post">                
                <h2 class="jumbotron text-center text-info">Student Registration</h2>
                  <div class="form-group">
                    <label for="studentId">Student Id</label>
                    <input type="text" class="form-control" id="studentId" name="student_id" required="required">
                  </div>
                  <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" class="form-control" id="studentName" name="student_name" required="required">
                  </div>
                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" class="form-control" id="dob" name="dob" required="required">
                  </div>                   
                    <input type="submit" name="submit" class="btn btn-info" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script><!--   jquery -->
<script language="javascript" src="js/bootstrap.js"></script>
<script language="javascript" src="js/moment.js"></script>
<script language="javascript" src="js/bootstrap-datetimepicker.js"></script>
<script>
$(document).ready(function()
{
  $('#dob').datetimepicker({
                 format: 'MM/DD/YYYY',
	});
});
</script>