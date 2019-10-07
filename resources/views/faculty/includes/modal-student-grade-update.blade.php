<div class="modal fade" id="gradeUpdate-{{ $s['grade_id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Grade Update</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Update Grade of Student</strong></p>
        <p>Name: <strong>{{ $s['firstname'] . ' ' . $s['lastname'] . ' - ' . $s['student_number'] }}</strong></p>
        <p>Subject: <strong>{{ ucwords($subject->code) }}</strong></p>
        <hr>
        <form action="{{ route('faculty.update.studet.grade.post') }}" method="POST">
          {{ csrf_field() }}
          <input type="hidden" name="grade_id" value="{{ $s['grade_id'] }}">
          <div class="form-group">
            <input type="number" name="grade" value="{{ $s['grade'] }}" class="form-control" min="1" max="5" step="0.25" required>
          </div>
          <div class="form-group">
            <button class="btn btn-danger"><i class="fa fa-floppy-o"></i> Save Grade</button>
          </div>
        </form>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>