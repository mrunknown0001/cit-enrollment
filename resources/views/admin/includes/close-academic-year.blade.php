<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#closeay">
  Close Academic Year
</button>

<div class="modal fade" id="closeay" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <strong>Close Academic Year</strong>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		<p>Click button below to Close Academic Year</p>
      </div>
      <div class="modal-footer">
        <form action="#" method="POST">
        	{{ csrf_field() }}
  			<button type="submit" class="btn btn-primary">Close Academic Year</button>
  		</form>
      </div>
    </div>
  </div>
</div>