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

    function getAllIssuedDocs() {
        $sql = "SELECT * FROM docs WHERE status='issued' AND balance=0 ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllActiveDocs() {
        $sql = "SELECT * FROM docs WHERE status='active' AND balance=0 ORDER BY id";
        $result = $this->db_handle->runBaseQuery($sql);
        return $result;
    }

    function getAllNotReadyDocs() {
        $sql = "SELECT * FROM docs WHERE status='active' AND balance>0 ORDER BY id";
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

    //get total amount paid
    function getTotalAmountPaid($con){

        $totalPurchases=mysqli_query($con,
        "SELECT SUM(amount) AS total FROM docs");

        $d=mysqli_fetch_assoc($totalPurchases);

        return $d['total'];
    }

    //get total balance
    function getTotalBalance($con){

        $totalPurchases=mysqli_query($con,
        "SELECT SUM(balance) AS total FROM docs ");

        $d=mysqli_fetch_assoc($totalPurchases);

        return $d['total'];
    }

     
    //return information about document
    function getDocumentById($itemID,$info,$con){

        $sql = "SELECT $info FROM docs WHERE  id='$itemID'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $data=$row["$info"];
               return $data;
            }
        }
        
    }

    //returning all certificates
    function getAllCertificates($con){
      $users=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE type='certificate'");
      $d=mysqli_fetch_assoc($users);
      return $d['totalcerts'];
    }

    //return certificates by year
     function getAllCertificatesbyYear($con,$year){
      $certs=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE type='certificate' AND issue_year='$year'");
      $d=mysqli_fetch_assoc($certs);
      return $d['totalcerts'];
    }

    //returning all passlips
    function getAllPasslips($con){
      $users=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE type='passlip'");
      $d=mysqli_fetch_assoc($users);
      return $d['totalcerts'];
    }

    //returning all passlips by year
     function getAllPasslipsByYear($con,$year){
      $users=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE type='passlip' AND issue_year='$year'");
      $d=mysqli_fetch_assoc($users);
      return $d['totalcerts'];
    }

    //returning all issued documents
    function getAllIssuedDocuments($con){
      $users=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE status='issued'");
      $d=mysqli_fetch_assoc($users);
      return $d['totalcerts'];
    }

    //returning all Ready documents
    function getAllReadyDocuments($con){
      $users=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE status='active' AND balance=0");
      $d=mysqli_fetch_assoc($users);
      return $d['totalcerts'];
    }

    //returning all Not Ready documents
    function getAllNotReadyDocuments($con){
      $users=mysqli_query($con,"SELECT COUNT(*) AS totalcerts FROM docs WHERE status='active' AND balance>0");
      $d=mysqli_fetch_assoc($users);
      return $d['totalcerts'];
    }

}
?>