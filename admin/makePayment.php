  <h3>Make Payment</h3>
  <form id="doc"  method='post' action='' enctype="multipart/form-data">
                 
    <div class="form-group col-md-12 col-lg-12">
      <label>Balance</label>
      <input type="text" name="code" id="code" class="form-control" required>
    </div>
    <div class="form-group col-md-12 col-lg-12">
      <label>Amount</label>
      <input type="text" name="amount" id="amount" class="form-control" required>
    </div>
       <input type="hidden" name="docid" id="docid" />
       <input type="submit"  value="Save" class="btn btn-success" /> 
</form>