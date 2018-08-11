<div class="modal fade" id="updateMiscFee-{{ $m->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Miscellaneous Fee</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
                <form action="{{ route('admin.update.misc.fee.post') }}" method="POST" autocomplete="off">
                  {{ csrf_field() }}
                  <input type="hidden" name="misc_id" value="{{ $m->id }}">
                      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name">Miscellaneous Fee Name</label><label class="label-required">*</label>
                        <input id="name" type="text" class="form-control" name="name" value="{{ $m->name }}" placeholder="Enter Miscellaneous Fee Name" autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount">Miscellaneous Fee Amount</label><label class="label-required">*</label>
                        <input id="amount" type="number" class="form-control" name="amount" value="{{ $m->amount }}" placeholder="Enter Miscellaneous Fee Amount">
                        @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                        @endif
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Update Miscellaneous Fee</button>
                      </div>
                </form>


      </div>
      <div class="modal-footer">
        Update Miscellaneous Fee Form
      </div>
    </div>
  </div>
</div>