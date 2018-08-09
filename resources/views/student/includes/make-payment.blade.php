	<p class=""><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#makePayment">Make Payment</button></p>

  <div class="modal fade" id="makePayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <strong>Make Payment</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-center">Choose Mode of Payment:</p>
          <div class="row">
            <div class="col-md-6">
              <p class="text-center">
                <a href="{{ route('student.tuition.fee.paypal.payment') }}">
                  <i class="fa fa-paypal fa-4x"></i><br>Paypal
                </a>
              </p>
            </div>
            <div class="col-md-6">
              <p class="text-center">
                <a href="{{ route('student.tuition.fee.card.payment') }}">
                  <i class="fa fa-credit-card fa-4x"></i><br>Card Payment
                </a>
              </p>
            </div>
          </div>
        </div>
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>