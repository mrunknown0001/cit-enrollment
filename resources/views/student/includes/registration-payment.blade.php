	<p class="text-center"><button type="button" class="btn btn-link" data-toggle="modal" data-target="#registrationPayment">Registration Payment Click Here</button></p>

  <div class="modal fade" id="registrationPayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <strong>Registration Payment</strong>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="text-center">Choose Mode of Payment:</p>
          <div class="row">
            <div class="col-md-4">
              <p class="text-center">
                <a href="{{ route('student.paypal.registration.payment') }}">
                  <i class="fa fa-paypal fa-4x"></i><br>Paypal
                </a>
              </p>
            </div>
            <div class="col-md-4">
              <p class="text-center">
                <a href="{{ route('student.card.registration.payment') }}">
                  <i class="fa fa-credit-card fa-4x"></i><br>Card Payment
                </a>
              </p>
            </div>
            <div class="col-md-4">
              <p class="text-center">
                <a href="{{ route('student.paymaya.registration.payment') }}">
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