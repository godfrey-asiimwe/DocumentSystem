<?php

//include database configuration file
include_once '../DB.php';

// file name
$filename = $_FILES['file']['name'];

// Location
$location = '../uploads/'.$filename;



// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif","pdf");

$doc_no=uniqid(3);
$code=$_POST['code'];
$level=$_POST['level'];
$name=$_POST['name'];
$regno=$_POST['regno'];
$year=$_POST['year'];
$amount=$_POST['amount'];

$time=time();
$date2=date("Y-m-d",$time); 
$Created_by='admin';

$status='active';

$query="INSERT INTO docs(file_name,Doc_no,Code,level,Holder,reg_no,issue_year,payment,status,date_creation,created_by) VALUES ('$filename','$doc_no','$code','$level','$name','$regno','$year','$amount','$status','$date2','$Created_by')";

 if (mysqli_query($con,$query)) {
 	
		$response = 0;
		if(in_array($file_extension,$image_ext)){
		  // Upload file
		  if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		    $response = $location;
		    
		  }
		}
 }else{
 	echo 'error: '.mysqli_error($con);
 }



