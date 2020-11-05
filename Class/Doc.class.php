<?php 
require_once ("DB.class.php");

class Doc
{
    private $db_handle;
    
    function __construct() {
        $this->db_handle = new DB();
    }
    
    
    
    function deleteAccount($doc_id) {
        $query = "DELETE FROM docs WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $doc_id
        );
        $this->db_handle->update($query, $paramType, $paramValue);
    }
    
    function getDocById($doc_id) {
        $query = "SELECT * FROM docs WHERE id = ?";
        $paramType = "i";
        $paramValue = array(
            $doc_id
        );
        
        $result = $this->db_handle->runBaseQuery($query);
        return $result;
    }

    function getSpecificAccount($doc_id,$con) {

        $sql = "SELECT * FROM docs WHERE  id='$doc_id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data=$row["Code"];
               echo $data;
            }
        } 
    }
    
    function getAllDocs() {
        $sql = "SELECT * FROM docs ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllDocsForSelection() {
        $sql = "SELECT * FROM docs ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);

          if (! empty($result)) {
            foreach ($result as $k => $v) {

           echo '<option value="'.$result[$k]["id"].'">'.$result[$k]["Code"].'</option>';

            }
        }
    }

    function getAmountOnDoc($doc_id,$con) {

        $sql = "SELECT payment FROM docs WHERE  id='$doc_id'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {

                $data=$row["payment"];
                return $data;
            }
        } 
    }
}
?>