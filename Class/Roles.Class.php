<?php 
require_once ("DB.class.php");

class Roles
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DB();
    }
    
    function addRole($name,$desc,$date_created,$Created_by) {

        $query = "INSERT INTO roles(name,des,Date_created,Created_by) VALUES (?, ?, ?, ?)";

        $paramType = "ssss";
        $paramValue = array(
            $name,
            $desc,
            $date_created,
            $Created_by
        );
        
        $insertId = $this->db_handle->insert($query, $paramType, $paramValue);

        return $insertId;
    }
    
    function editRole($name,$des,$role_id) {
        $query = "UPDATE roles SET name = ?,des = ? WHERE id = ?";
        $paramType = "ssi";
        $paramValue = array(
            $name,
            $des,
            $org_id
        );
        
        $this->db_handle->update($query, $paramType, $paramValue);
    }

    function deleteRole($role_id) {
        $query = "DELETE FROM roles WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $org_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getRoleById($role_id) {
        $query = "SELECT * FROM roles WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $org_id
        );
        
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getSpecificRole($role_id,$con) {

        $sql = "SELECT * FROM roles WHERE  id='$role_id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data=$row["name"];
               return $data;
            }
        } 
    }
    
    function getAllRoles() {
        $sql = "SELECT * FROM roles ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllRolesForSelection() {
        $sql = "SELECT * FROM roles ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);

          if (! empty($result)) {
            foreach ($result as $k => $v) {

           echo '<option value="'.$result[$k]["id"].'">'.$result[$k]["name"].'</option>';

            }
        }
    }

}
?>