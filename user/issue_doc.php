
<?php 
include "../DB.php";

$id = 0;
if(isset($_POST['id'])){
   $id = mysqli_real_escape_string($con,$_POST['id']);
}

if($id > 0){

	// Check record exists
	$checkRecord = mysqli_query($con,"SELECT * FROM docs WHERE id=".$id);
	$totalrows = mysqli_num_rows($checkRecord);

	if($totalrows > 0){
		// Delete record
		$query = " UPDATE docs   
           SET status='issued' WHERE id=".$id;
		mysqli_query($con,$query);

		$comment='document issued';

		$time=time();
		$date2=date("Y-m-d",$time); 
		$Created_by='user';

		$query2="INSERT INTO issue(doc_id, comment, date_creation, created_by) VALUES ('$id','$comment','$date2','$Created_by')";

		mysqli_query($con,$query2);

		echo 1;
		exit;
	}else{
        echo 0;
        exit;
    }
}

echo 0;
exit;