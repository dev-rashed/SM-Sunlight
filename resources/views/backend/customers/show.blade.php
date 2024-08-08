@php
  use App\Models\Store;
@endphp
@extends('layouts/layoutMaster')

@section('title', ' View - Customer')

@section('vendor-style')
<style>
  .imagePreview img {
    max-width: 100%;
    box-shadow: 1px 1px 4px #adabab;
    margin-top: 10px;
}
</style>
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
@endsection


@section('content')
    <h4 class="py-1 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Dashboard / Customer /</span> View</h4>

<!-- Form with Tabs -->

<div class="row">
  <div class="col">
    <div class="card mb-3 p-3">
      <div class="row g-3">
          <div class="col-md-6">
              <label class="form-label" for="full_name">Full Name</label>
              <input type="text" name="full_name" value="{{ $customer->name }}" disabled  class="form-control" />
          </div>
          <div class="col-md-6">
            <label class="form-label" for="date">Date</label>
            <input type="text" name="date" value="{{ $customer->date }}" disabled  class="form-control datepicker"/>
          </div>
          <div class="col-md-6">
              <label class="form-label" for="address">Address</label>
              <input type="text" name="address" value="{{ $customer->address }}" disabled  class="form-control" />
          </div>
          <div class="col-md-6">
            <label class="form-label" for="phone">Phone</label>
            <input type="text" name="phone" value="{{ $customer->phone }}" disabled  class="form-control"/>
          </div>
          <div class="col-md-6">
              <label class="form-label" for="battery_type">Battery Type</label>
              <input type="text" name="phone" value="{{ $customer->battery_type }}" disabled class="form-control"/>
          </div>
          <div class="col-md-6">
            <label class="form-label" for="added_at">Added At</label>
            <input type="text" value="{{ $customer->created_at }}" disabled class="form-control"/>
          </div>
          <div class="col-md-12">
            <label class="form-label" for="comment">Comment</label>
            <textarea name="comment" rows="5" class="form-control" disabled  >{{ $customer->comment }}</textarea>
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
            <div class="selfieImagePreview imagePreview">
              <img src="{{ asset('selfies/' . $customer->selfie) }}" alt="">
            </div>
        </div>
        <div class="col-md-6">
          <label class="form-label" for="map_screenshot">Google Map Screenshot</label>
          <div class="screenshotImagePreview imagePreview">
            <img src="{{ asset('map_screenshot/' . $customer->map) }}" alt="">
          </div>
      </div>
    </div>
  </div>
</div>


@endsection

@section('page-script')
    <script src="{{ asset('assets/js/form-layouts.js') }}"></script>
<script>
  $(document).ready(function () {
    $('.datepicker').datepicker({
        format: 'mm/dd/yyyy',
    });


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
