<form action="{{ route('solarprogram.update', $solar->id) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="modal-header">
      <h5 class="modal-title" id="addSolarProgramModalLabel">Add new solar program</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  <div class="modal-body">
      <div class="row append_edited_solar_program">
          <div class="mb-3 col-8">
              <label class="form-label" for="name">Finance Program</label>
              <input type="text" class="form-control text-uppercase" value="{{$solar->name}}" id="name" name="name" required/>
          </div>
          <div class="mb-3 col-4">
              <div class="btn-group mt-4 float-end">
                <button type="button" class="edited_add_program btn btn-primary">+</button>
              </div>
          </div>
          <?php
              $details = json_decode($solar->details, true);
          ?>
          @foreach ($details as $i=>$item)
            <div class="col-12 border">
                <div class="row">
                    <div class="mb-3 col-3">
                        <label class="form-label" for="interest_rate"><small>Interest Rate</small></label>
                        <input type="text" class="form-control form-control-sm" id="interest_rate"
                            name="intereset[]" value="{{$item['interest']}}" required />
                    </div>
                    <div class="mb-3 col-2">
                        <label class="form-label" for="year"><small>Year</small></label>
                        <input type="text" class="form-control form-control-sm" id="year" name="year[]" value="{{$item['year']}}" required />
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label" for="net_price"><small>Net Price(/Watt)</small></label>
                        <input type="text" class="form-control form-control-sm" id="net_price" name="net_price[]" value="{{$item['net_price']}}" required/>
                    </div>
                    <div class="mb-3 col-3">
                        <label class="form-label" for="dealer_fee"><small>Dealer Fee</small></label>
                        <input type="text" class="form-control form-control-sm" id="dealer_fee" name="dealer_fee[]" value="{{@$item['dealer_fee']}}" required/>
                    </div>
                    <div class="mb-3 col-1 mt-4" style="margin-left: -17px">
                          <button type="button" class="remove_program btn btn-sm btn-danger">-</button>
                    </div>
                </div>
            </div>
          @endforeach
      </div>
  </div>
  <div class="modal-footer">
      <button type="button" class="btn btn-secondary text-white"
          data-bs-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary text-white update_solar_program"
          data-bs-dismiss="modal">Update</button>
  </div>
</form>
