 <?php

include ('../DB.php');
require_once ("../Class/DB.class.php");
require_once ("../Class/User.class.php");

 if($_POST["userid"] != '')  
      {  

      	$firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role_id = $_POST['role'];
        $password=md5($firstname);

          $query = "  
           UPDATE users   
           SET firstname='$firstname',   
           lastname='$lastname',   
           email='$email', 
           password='$password', 
           role = '$role'   
           WHERE id='".$_POST["userid"]."'"; 

         if (mysqli_query($con,$query)) {
         	echo 'success';
         }else{
         	echo 'error: '.mysqli_error($con);
         }
    }else{


        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $role_id = $_POST['role'];

        $password=md5($firstname);

        $time=time();
        $date_created=date("Y-m-d",$time); 

        $created_by='admin';

        $user = new Users();
        $insertId = $user->addUser($firstname,$lastname,$email,$password,$role_id,$date_created,$created_by);

    }
 ?>