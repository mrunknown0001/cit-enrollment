<div class="modal fade" id="updateUnitPrice" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Unit Price Fee</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
                <form action="{{ route('admin.update.unit.price.post') }}" method="POST" autocomplete="off">
                  {{ csrf_field() }}
                      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount">Miscellaneous Fee Amount</label><label class="label-required">*</label>
                        <input id="amount" type="number" class="form-control" name="amount" value="{{ $unit_price->amount }}" placeholder="Enter Miscellaneous Fee Amount">
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Update Unit Price</button>
                      </div>
                </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>