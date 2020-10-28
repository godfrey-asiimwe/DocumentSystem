<?php 
require_once ("DB.class.php");

class Users
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DB();
    }
    
    function addUser($firstname,$lastname,$email,$password,$role_id,$date_created,$created_by) {

        $query = "INSERT INTO users(firstname,lastname,email,password,role_id,date_created,created_by) VALUES (?, ?,?,?,?,?,?)";

        $paramType = "ssssiss";
        $paramValue = array(
            $firstname,
            $lastname,
            $email,
            $password,
            $role_id,
            $date_created,
            $created_by
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        return $insertId;
    }
    
    function editAccount($name,$des,$org_id) {
        $query = "UPDATE account SET name = ?,des = ? WHERE id = ?";
        $paramType = "ssi";
        $paramValue = array(
            $name,
            $des,
            $org_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function editAccountAmount($amount,$acc_id) {
        $query = "UPDATE account SET amount = ? WHERE id = ?";
        $paramType = "si";
        $paramValue = array(
            $amount,
            $acc_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function deleteAccount($acc_id) {
        $query = "DELETE FROM account WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $org_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getAccountById($user_id) {
        $query = "SELECT * FROM users WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $org_id
        );
        
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getSpecificAccount($user_id,$con) {

        $sql = "SELECT * FROM account WHERE  id='$user_id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data=$row["name"];
               echo $data;
            }
        } 
    }
    
    function getAllUsers() {
        $sql = "SELECT * FROM users ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllUserForSelection() {
        $sql = "SELECT * FROM users ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);

          if (! empty($result)) {
            foreach ($result as $k => $v) {

           echo '<option value="'.$result[$k]["id"].'">'.$result[$k]["firstname"].'</option>';

            }
        }
    }

    function getAmountOnAccount($acc_id,$con) {

        $sql = "SELECT amount FROM account WHERE  id='$acc_id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                $data=$row["amount"];
                return $data;
            }
        } 
    }
}
?>