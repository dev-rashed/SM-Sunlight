@php
  use App\Models\Store;
@endphp
@extends('layouts/layoutMaster')

@section('title', ' Edit - Customer')

@section('vendor-style')
<style>
.imagePreview img {
    max-width: 100px;
    box-shadow: 0px 1px 6px #adabab;
    margin-top: 10px;
    border: 1px solid #a8a0a0;
}
</style>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css')}}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
@endsection


@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Dashboard / Customer </span>Update</h4>

<!-- Form with Tabs -->
<form action="{{route('customers.update', $customer->id)}}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
  <div class="col">
    <div class="card mb-3 p-3">

      <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label" for="full_name">Full Name</label>
            <input type="text" name="full_name" value="{{ $customer->name }}" class="form-control" />
        </div>
        <div class="col-md-6">
          <label class="form-label" for="date">Date</label>
          <input type="text" name="date" value="{{ $customer->date }}" class="form-control datepicker"/>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="address">Address</label>
            <input type="text" name="address" value="{{ $customer->address }}" class="form-control" />
        </div>
        <div class="col-md-6">
          <label class="form-label" for="phone">Phone</label>
          <input type="text" name="phone" value="{{ $customer->phone }}" class="form-control"/>
        </div>
        <div class="col-md-6">
            <label class="form-label" for="battery_type">Battery Type</label>
            <select name="battery_type" id="battery_type" class="form-control">
              <option value="EV" {{ $customer->battery_type == "EV" ? "selected" : "" }}>EV</option>
              <option value="ER" {{ $customer->battery_type == "ER" ? "selected" : "" }}>ER</option>
            </select>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="added_at">Added At</label>
          <input type="text" value="{{ $customer->created_at }}" disabled class="form-control"/>
        </div>
        <div class="col-md-12">
          <label class="form-label" for="comment">Comment</label>
          <textarea name="comment" rows="5" class="form-control">{{ $customer->comment }}</textarea>
        </div>

    </div>
    <hr>
    <div class="row g-3">
      <h5 class="mb-0">Added By</h5>
      <div class="col-md-6 mt-0">
        <label class="form-label">Name</label>
        <input type="text" value="{{ $customer->addedBy->name }}" disabled class="form-control"/>
      </div>

      <div class="col-md-6 mt-0">
        <label class="form-label">Store</label>
        @php
          $store = Store::where('id', $customer->addedBy->store_id)->first();
        @endphp
        <input type="text" value="{{ @$store->name }}" disabled class="form-control"/>
      </div>
    </div>
    <hr>
    <div class="row g-3">
      <div class="col-md-6">
          <label class="form-label" for="selfie_with_customer">Selfie with customer</label>
          <input type="file" class="form-control mb-1" value="{{ $customer->selfie }}" accept=".jpg,.jpeg,.png" name="selfie_with_customer">
          <div class="selfieImagePreview imagePreview">
            <img src="{{ $customer->selfie ? asset('selfies/'. $customer->selfie) : asset('assets/img/no-preview.jpeg') }}" alt="">
          </div>
      </div>
      <div class="col-md-6">
        <label class="form-label" for="map_screenshot">Google Map Screenshot</label>
        <input type="file" class="form-control mb-1" value="{{ $customer->map }}" name="map_screenshot" accept=".jpg,.jpeg,.png">
        <div class="screenshotImagePreview imagePreview">
          <img src="{{ $customer->map ? asset('map_screenshot/'. $customer->map) : asset('assets/img/no-preview.jpeg') }}" alt="">
        </div>
    </div>
    <hr>
    <div class="row">
       <div class="col-12 px-0">
          <input type="submit" class="btn btn-primary form-control">
       </div>
    </div>
    </div>
  </div>
</div>

</form>

@endsection

@section('page-script')
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
  <script>
    $(document).ready(function () {
      $('.datepicker').datepicker({
          format: 'dd/mm/yyyy',
      });
      $('[name="selfie_with_customer"]').on("change", function() {
      var _file = $(this)[0].files[0];
      var _reader = new FileReader();
      _reader.onloadend = function() {
        $(".selfieImagePreview").find('img').attr('src', _reader.result);
      }
      if (_file) {
        _reader.readAsDataURL(_file);
      } else {
        $(".selfieImagePreview").find('img').attr('src', "{{ asset('assets/img/no-preview.jpeg') }}");
      }
    })

    $('[name="map_screenshot"]').on("change", function() {
      var _file = $(this)[0].files[0];
      var _reader = new FileReader();
      _reader.onloadend = function() {
        $(".screenshotImagePreview").find('img').attr('src', _reader.result);
      }
      if (_file) {
        _reader.readAsDataURL(_file);
      } else {
        $(".screenshotImagePreview").find('img').attr('src', "{{ asset('assets/img/no-preview.jpeg') }}");
      }
    })
    })
  </script>

@endsection
@section('page-style')
<style>
.table > :not(caption) > * > * {
  padding: 0.25rem .5rem;
}
.text-bold {
  font-weight: bold;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
  -moz-appearance: textfield;
}
input[readonly],
input[readonly]:focus {
  background: #ddd;
}
</style>
@endsection
