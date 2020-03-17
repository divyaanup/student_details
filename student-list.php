<?php
  include_once("settings.php");
  $list=$studobj->listStudent();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Students List</title>
<link rel="stylesheet" href="css/bootstrap.css"/>
<link rel="stylesheet" src="css/bootstrap-datetimepicker.min.css"/>
</head>
<body>
    <div class="container">     
        <?php include('menu.php');?>
        <div class="row">       
            <div class="col-md-9">
            <h2 class="jumbotron text-center text-info">Students List</h2>
                <table class="table">
                <thead>                
                <tr>
                <th scope="col">#</th>
                <th scope="col">Student ID</th>
                <th scope="col">Student Name</th>
                <th scope="col">Date of Birth</th>
                <th scope="col">Course</th>
                <th scope="col">Score</th>
                </tr>
                </thead>
                <tbody> 
                <?php 
				$i=1;
				foreach($list as $lst) 
				{?>             
                <tr>
                <th scope="row"><?php echo $i;?></th>
                <td><?php echo $lst['student_id'];?></td>
                <td><?php echo $lst['student_name'];?></td>
                <td><?php echo $lst['dob'];?></td>
                <td><?php echo $lst['course_name'];?></td>
                <td><?php echo $lst['score'];?></td>
                </tr>
                <?php 
				$i++;
				}?>
                </tbody>
                </table>			
            </div>
        </div>
    </div>
</body>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script><!--   jquery -->
<script language="javascript" src="js/bootstrap.js"></script>
