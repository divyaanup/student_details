<?php
include_once("settings.php");
if(isset($_REQUEST['student_id']))
{
	$stud_details=$studobj->checkStudent($_REQUEST['student_id']);
    echo $stud_details[0]['student_name']."|".$stud_details[0]['dob'];
}
?>
