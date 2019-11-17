<div class="modal fade" id="tagging-{{ $s->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Payment Tagging</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row">
          <div class="col-md-12">
            <p>Name: <strong>{{  $s->firstname . ' ' . $s->lastname }}</strong></p>
            <p>LRN: <strong>{{ $s->student_number }}</strong></p>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <a href="" class="btn btn-primary">Partial Payment</a>
            <a href="" class="btn btn-success">Full Payment</a>
          </div>
        </div>


      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>