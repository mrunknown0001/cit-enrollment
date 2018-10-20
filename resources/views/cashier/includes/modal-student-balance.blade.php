<div class="modal fade" id="studentBalance-{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Student Balance</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <p>Name: <strong>{{  $s->firstname . ' ' . $s->lastname }}</strong></p>
        <p>Student Number: <strong>{{ $s->student_number }}</strong></p>

        <p>Current Balance: <strong>{{ $s->balance && $s->balance->balance > 0 ? "&#8369; " . $s->balance->balance : 'No Balance' }}</strong></p>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>