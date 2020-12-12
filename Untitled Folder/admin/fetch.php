 
  <?php  
 //fetch.php  
 $connect = mysqli_connect("localhost", "root", "", "MDS");  
 if(isset($_POST["userid"]))  
 {  
      $query = "SELECT * FROM users WHERE id ='".$_POST["userid"]."'";  
      $result = mysqli_query($connect, $query);  
      $row = mysqli_fetch_array($result);  
      echo json_encode($row);  
 }  
 ?>