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
            <div class="col-md-4">
              <p class="text-center">
                <a href="{{ route('student.tuition.fee.paypal.payment') }}">
                  <i class="fa fa-paypal fa-4x"></i>
                  <p class="text-center">Paypal</p>
                </a>
              </p>
            </div>
            <div class="col-md-4">
              <p class="text-center">
                <a href="{{ route('student.tuition.fee.card.payment') }}">
                  <i class="fa fa-credit-card fa-4x"></i>
                  <p class="text-center">Card Payment</p>
                </a>
              </p>
            </div>
            <div class="col-md-4">
              <p class="text-center">
                <a href="{{ route('student.tuition.fee.paymaya') }}">
                  <img src="{{ asset('/uploads/paymaya.png') }}" class="img-responsive" width="70px" style="margin-top: -12px; margin-left: 45px; padding-bottom: -55px !important">
                    <p class="text-center" style="margin-top: -8px">Paymaya</p>
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