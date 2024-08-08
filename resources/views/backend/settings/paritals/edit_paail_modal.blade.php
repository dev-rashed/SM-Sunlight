<form action="{{ route('paail.update', $paail->id) }}" method="POST">
  @csrf
  @method("PUT")
  <div class="modal-header">
      <h5 class="modal-title" id="editpaailModalLabel">Edit paail</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
      <div class="mb-3">
          <label class="form-label" for="paail">Paail</label>
          <input type="text" class="form-control" value="{{$paail->title}}" id="paail" name="paail" />
      </div>
      <div class="mb-3">
        <label class="form-label" for="Discount">Discount</label>
          <div class="input-group mb-3">
            <input type="text" class="form-control" value="{{$paail->discount}}" id="Discount" name="discount" />
            <span class="input-group-text">%</span>
          </div>
      </div>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-secondary text-white"
          data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary text-white submit"
          data-bs-dismiss="modal">Update</button>
  </div>
</form>
