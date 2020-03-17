<?php
ob_start();
error_reporting(E_ALL ^ E_NOTICE);
include_once("config.php");
include_once("lib/class.mysqlcls.php");
include_once("lib/class.student.php");
$studobj=new student();


