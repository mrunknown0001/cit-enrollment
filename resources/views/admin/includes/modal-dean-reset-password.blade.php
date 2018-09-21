<div class="modal fade" id="deanResetPass-{{ $d->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Reset Password</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <p>Are you sure, you want to Reset Password of Dean?</p>
      <form action="{{ route('admin.reset.dean.password.post') }}" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="dean_id" value="{{ $d->id }}">
        </div>
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Reset Password</button>
      </form>
        </div>
      </div>
    </div>
  </div>