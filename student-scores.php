<?php
include_once("settings.php");
$msg="";$_scorearr=array();
if(isset($_POST['submit']))
{
	$_scorearr['s_id']=$_POST['studentId'];
	$_scorearr['course_id']=$_POST['course'];
	$_scorearr['score']=$_POST['score'];
	$studobj->insertScore($_scorearr);
	$msg="Submitted Successfully";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Scores</title>
<link rel="stylesheet" href="css/bootstrap.css"/>
</head>
<body>
    <div class="container">
            <?php include('menu.php');?>
          <div class="row">
            <div class="col-md-9">
                <?php if($msg!=""){?>
                 <div class="alert alert-success text-center" role="alert">
                 <?php echo $msg;?>
                </div>
               <?php }?>
                <form name="stud_score" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
                <h2 class="jumbotron text-center text-info">Student Scores</h2>
                  <div class="form-group">
                   <?php $stud_det=$studobj->getStudent();?>                  
                    <select id="studentId" class="form-control" name="studentId" required>
                    <option selected value="">Choose Student</option> 
                    <?php foreach($stud_det as $stud) {?>
                    <option value="<?php echo $stud['s_id'];?>"><?php echo $stud['student_id'];?></option> 
                    <?php }?>
                    </select>                 
                  </div>
                  <div class="form-group">
                    <label for="studentName">Student Name</label>
                    <input type="text" class="form-control" id="studentName" name="student_name" required="required" disabled="disabled">
                  </div>
                  <div class="form-group">
                    <label for="dob">Date of Birth</label>
                    <input type="text" class="form-control" id="dob" name="dateofbirth" required="required" disabled="disabled">
                  </div>
                   <div class="form-group">
                    <label for="course">Course</label>
                    <?php $course_det=$studobj->getCourse();?> 
                    <select id="course" name="course" class="form-control" required>                  
                    <option selected value="">Choose Course</option>                  
                    <?php foreach($course_det as $course) {?>
                    <option value="<?php echo $course['course_id'];?>"><?php echo $course['course_name'];?></option> 
                    <?php }?>
                    </select>     
                  </div>
                   <div class="form-group">
                    <label for="score">Score</label>
                    <input type="text" class="form-control" id="score" name="score" required="required">
                  </div>
                    <input type="submit" name="submit" class="btn btn-info" value="Submit">
                </form>
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script><!--   jquery -->
<script language="javascript" src="js/bootstrap.js"></script>
<script>
$("#studentId").on("change",function()
	{	
	$.ajax({
	type:"post",
	url:"checkstudent.php",
	data:"student_id="+ $("#studentId").val(),
	success : function(data){
		if(data!=0)
		{
			var res = data.split("|");			
		    $("#studentName").val(res[0]);
			$("#dob").val(res[1]);
		}
	},
	error:function()
	{
	alert("error");	
	}
});
	});
	</script>
</html>