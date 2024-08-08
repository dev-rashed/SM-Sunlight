<form action="{{ route('brand.update', $brand->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="modal-header">
      <h5 class="modal-title" id="editBrandModalLabel">Edit brand</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body pb-0">
      <div class="mb-3">
          <label class="form-label" for="name">Brand Name</label>
          <input type="text" class="form-control" id="name" value="{{$brand->name}}" name="name" />
      </div>
      <div class="mb-3" id="edit_tonage_append">
        @php
            $tons = json_decode($brand->tonage, true);
        @endphp
        @foreach ($tons as $item)
            <div class="row">
              <div class="col-4">
                <label class="form-label" for="Tonage">Tonage</label>
                <input type="text" class="form-control" id="Tonage" value="{{ $item['tonage'] }}" name="tonage[]" required/>
              </div>
              <div class="col-4">
                <label class="form-label" for="Price">Price</label>
                <input type="text" class="form-control" id="Price" value="{{ $item['price'] }}" name="price[]" required/>
              </div>
              <div class="col-2">
                <label for=""></label>
                <div class="btn-group">
                  <button type="button" class="btn btn-primary edit_tonage_append"><strong>+</strong></button>
                  <button type="submit" class="btn btn-danger remove_tonage"><strong>-</strong></button>
                </div>
              </div>
            </div>
        @endforeach

      </div>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-secondary text-white"
          data-bs-dismiss="modal">Close</button>
      <button type="buttom" class="btn btn-primary text-white">Update</button>
  </div>
</form>
