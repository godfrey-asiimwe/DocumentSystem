<?php

//include database configuration file
include_once '../DB.php';

$doc_no=uniqid(3);
$code=$_POST['code'];
$level=$_POST['level'];
$name=$_POST['name'];
$regno=$_POST['regno'];
$year=$_POST['year'];
$amount=$_POST['amount'];
$type=$_POST['type'];

$time=time();
$date2=date("Y-m-d",$time); 
$Created_by='admin';

$status='active';
$initial=0;


$query="INSERT INTO docs(file_name,Doc_no,Code,level,type,Holder,reg_no,issue_year,payment,amount,balance,status,date_creation,created_by) VALUES ('$filename','$doc_no','$code','$level','$type','$name','$regno','$year','$amount','$initial','$amount','$status','$date2','$Created_by')";

 if (mysqli_query($con,$query)) {
 	
	$response = 0;

 }else{
 	echo 'error: '.mysqli_error($con);
 }



