<div class="modal fade" id="viewFacultyLoad-{{ $f->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>View Faculty Load</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        @if(count($f->subjects) > 0)
          <p>Number of Subjects: {{ count($f->subjects) }}</p>
          <ul>
          @foreach($f->subjects as $s)
            <li>{{ $s->subject->code }} <a href="{{ route('admin.delete.faculty.load', ['id' => $s->id]) }}" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></li>
          @endforeach
          </ul>
        @else
        <p class="text-center">No Subject Load Assigned!</p>
        @endif

      </div>
      <div class="modal-footer">
        View Faculty Load
      </div>
    </div>
  </div>
</div>