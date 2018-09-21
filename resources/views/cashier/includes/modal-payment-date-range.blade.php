<div class="modal fade" id="dateRangePayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Payment Report</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="{{ route('cashier.payment.generate.report.custom.date') }}" method="GET">
          <div class="form-group">
            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="mm/dd/yyyy" required="">
          </div>
          <div class="form-group">
            <input type="date" name="end_date" id="end_date" class="form-control" placeholder="mm/dd/yyyy" required="">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Generate Report</button>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>