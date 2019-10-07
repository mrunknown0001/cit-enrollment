<div class="modal fade" id="updateRoom-{{ $r->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Update Room</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

            <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
            <form action="{{ route('dean.update.room.post') }}" method="POST" autocomplete="off">
              {{ csrf_field() }}
              <input type="hidden" name="room_id" value="{{ $r->id }}">
              <div class="form-group{{ $errors->has('room_name') ? ' has-error' : '' }}">
                    <label for="room_name">Room Name/Number</label><label class="label-required">*</label>
                    <input id="room_name" type="text" class="form-control" name="room_name" value="{{ $r->name }}" placeholder="Enter Room Name/Number" autofocus required>
                    @if ($errors->has('room_name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('room_name') }}</strong>
                        </span>
                    @endif
                  </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-danger"><i class="fa fa-floppy-o"></i> Update Room</button>
                </div>
              </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>