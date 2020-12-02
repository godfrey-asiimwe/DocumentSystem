
<div class="col-6"> 

</div>

<div class="col-6">  
  <?php

$id2=$_GET['makePayment'];

$initialamount=$doc->getDocumentById($id2,'Payment',$con);
$balance=$doc->getDocumentById($id2,'balance',$con);
$amount1=$doc->getDocumentById($id2,'amount',$con);

$amountDemanded=$initialamount-$amount1;

$time=time();
$date2=date("Y-m-d",$time); 

$id=$_SESSION['id'];


if(isset($_POST['submit'])){

    $amount2=$_POST['amount'];
    $amount=$amount1+$amount2;
    $balance=$amountDemanded-$amount2;
    
    $sql="UPDATE docs SET amount='$amount',balance='$balance' WHERE id='$id2'";

    if(mysqli_query($con, $sql)){

      $query2="INSERT INTO payments(docId,amount,balance,entry_date,created_by) VALUES ('$id2','$amount2','$balance','$date2','$id')";

      mysqli_query($con,$query2);

    }

    echo ' <a href="notreadydoc.php" class="btn btn-primary btn-lg btn-block btn-icon-split">You have successfuly Payed '.number_format($amount2).' click to go back to the list
                        </a><br><br>';

  }


?>
  <h3>Make Payment</h3>
  <form  method='post' action='<?php echo $_SERVER['SCRIPT_NAME']?>?makePayment=<?php echo $id2;?>' enctype="multipart/form-data">
                 
    <div class="form-group col-md-12 col-lg-12">
      <label>The Student has a balance of <?php echo $amountDemanded; ?></label>
    </div>
    <div class="form-group col-md-12 col-lg-12">
      <label>Amount</label>
      <input type="text" name="amount" id="amount" class="form-control" required>
    </div>
       <input type="submit" name="submit" value="Pay" class="btn btn-success" /> 
  </form>
</div>