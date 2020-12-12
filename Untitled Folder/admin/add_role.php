 <?php

include ('../DB.php');
require_once ("../Class/DB.class.php");
require_once ("../Class/Roles.Class.php");

 if (isset($_POST['name'])) {

        $name = $_POST['name'];
        $desc=$_POST['desc'];

        $time=time();
        $date2=date("Y-m-d",$time); 
        $Created_by='admin';

        $role = new Roles();
        $insertId = $role->addRole($name,$desc,$date2,$Created_by);

    }
 ?>