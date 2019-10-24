<div class="modal fade" id="updateStrand-{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Strand</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
        <form action="{{ route('admin.post.update.strand') }}" method="POST" role="form" autocomplete="off">
          {{ csrf_field() }}
          <input type="hidden" name="strand_id" value="{{ $s->id }}">
          <div class="row">
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                  <label for="strand">Strand</label><label class="label-required">*</label>
                  <input id="strand" type="text" class="form-control" name="strand" value="{{ $s->strand }}" placeholder="Enter Strand" autofocus required>
                  @if ($errors->has('strand'))
                      <span class="help-block">
                          <strong>{{ $errors->first('strand') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
                  <label for="code">Strand Code</label><label class="label-required">*</label>
                  <input id="code" type="text" class="form-control" name="code" value="{{ $s->code }}" placeholder="Enter Strand Code" required>
                  @if ($errors->has('code'))
                      <span class="help-block">
                          <strong>{{ $errors->first('code') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                  <label for="description">Strand Description</label>
                  <input id="description" type="text" class="form-control" name="description" value="{{ $s->description }}" placeholder="Enter Strand Description" >
                  @if ($errors->has('description'))
                      <span class="help-block">
                          <strong>{{ $errors->first('description') }}</strong>
                      </span>
                  @endif
                </div>
            </div>
            
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-danger"><i class="fa fa-plus"></i> Update Strand</button>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>