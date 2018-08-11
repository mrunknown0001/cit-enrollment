<div class="modal fade" id="addRoom" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Add Room</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

                <p><em>Field with red asterisk (<label class="label-required">*</label>) are required fields.</em></p>
                <form action="{{ route('admin.add.room.post') }}" method="POST" autocomplete="off">
                  {{ csrf_field() }}
                  <div class="form-group{{ $errors->has('room_name') ? ' has-error' : '' }}">
                        <label for="room_name">Room Name</label><label class="label-required">*</label>
                        <input id="room_name" type="text" class="form-control" name="room_name" value="{{ old('room_name') }}" placeholder="Enter Room Name" autofocus>
                        @if ($errors->has('room_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('room_name') }}</strong>
                            </span>
                        @endif
                      </div>
                  <div class="form-group{{ $errors->has('room_number') ? ' has-error' : '' }}">
                        <label for="room_number">Room Number</label><label class="label-required">*</label>
                        <input id="room_number" type="text" class="form-control" name="room_number" value="{{ old('room_number') }}" placeholder="Enter Room Number" autofocus>
                        @if ($errors->has('room_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('room_number') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Save Room</button>
                    </div>
                  </form>


      </div>
      <div class="modal-footer">
        Add Room Form
      </div>
    </div>
  </div>
</div>