@extends('layouts/layoutMaster')

@section('title', 'Legends Settings')

@section('vendor-style')
    @include('vendor.datatable.styles')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">Settings/</span> Legends</h4>

    <!-- Basic Layout -->
    <div class="row">
        {{-- <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header pb-1 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Finance</h5><button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addFinanceModal">Add Finance</button>
                </div>
                <div class="card-body p-0">
                    <div class="card-datatable">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th>Finance</th>
                                    <th>Discount</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($finances as $finance)
                                    <tr>
                                        <td>{{ $finance->type }}</td>
                                        <td>{{ $finance->discount }}%</td>
                                        <td>
                                            <a type="button" class="edit_finance" data-bs-toggle="modal"
                                                data-bs-target="#editFinanceModal" data-id="{{ $finance->id }}"><i
                                                    class="bx bx-edit"></i></a>
                                            <a type="button" class="delete_finance" data-bs-toggle="modal"
                                                data-bs-target="#deleteFinanceModal" data-id="{{ $finance->id }}"><i
                                                    class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {!! $finances->links() !!}
                    </div>
                </div>
            </div>

        </div> --}}

        <div class="col-xl-3">
            <div class="card mb-4">
                <div class="card-header pb-1 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Panel <span class="text-muted">(W)</span></h5>
                </div>
                <div class="card-body p-0">
                    <form action="{{ route('panel.store') }}" method="POST">
                        @csrf
                        <div class="row p-2">
                            <input type="hidden" name="legends[]">
                            <div class="col-8"><input type="text" class="form-control" name="panel"></div>
                            <div class="col-4"><input type="submit" value="Add" class="btn btn-primary px-1"></div>
                        </div>
                    </form>
                    <div class="">
                        <table class="datatables-basic table table-bordered">
                            <tbody>
                                @foreach ($panels as $panel)
                                    <tr>
                                        <td class="p-0 text-center">{{ $panel->panel }}</td>
                                        <td class="p-0 text-center" style="width: 40px">
                                            <form action="{{ route('panel.destroy', $panel->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" type="submit"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-xl-4">
            <div class="card mb-4">
                <div class="card-header pb-2 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Brands</h5><button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addBrandModal">Add Brand</button>
                </div>
                <div class="card-body p-0">
                    <div class="card-datatable">
                        <table class="datatables-basic table table-bordered">
                            <thead>
                                <tr>
                                    <th>Brand</th>
                                    <th class="p-1"><small>Tonage - Price</small></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td class="p-0">
                                            @php
                                                $tons = json_decode($brand->tonage, true);
                                            @endphp
                                            @foreach ($tons as $item)
                                                <p class="border-bottom m-0 text-center">{{ $item['tonage'] }} -
                                                    {{ $item['price'] }}</p>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a type="button" class="edit_brand" data-bs-toggle="modal"
                                                data-bs-target="#editBrandModal" data-id="{{ $brand->id }}"><i
                                                    class="bx bx-edit"></i></a>
                                            <a type="button" class="delete_brand" data-bs-toggle="modal"
                                                data-bs-target="#deleteBrandModal" data-id="{{ $brand->id }}"><i
                                                    class="bx bx-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        {{-- <div class="col-xl-4">
          <div class="card mb-4">
              <div class="card-header pb-1 d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Paail</h5><button class="btn btn-primary" data-bs-toggle="modal"
                      data-bs-target="#addpaailModal">Add Paail</button>
              </div>
              <div class="card-body p-0">
                  <div class="card-datatable">
                      <table class="datatables-basic table table-bordered">
                          <thead>
                              <tr>
                                  <th>Paail</th>
                                  <th>Discount</th>
                                  <th></th>
                              </tr>
                          </thead>
                          <tbody>
                            @foreach ($paails as $paail)
                                <tr>
                                  <td>{{ $paail->title }}</td>
                                  <td>{{ $paail->discount }}%</td>
                                  <td>
                                    <a type="button" class="edit_paail" data-bs-toggle="modal" data-bs-target="#editpaailModal" data-id="{{ $paail->id }}"><i class="bx bx-edit"></i></a>
                                    <a type="button" class="delete_paail" data-bs-toggle="modal" data-bs-target="#deletepaailModal" data-id="{{ $paail->id }}"><i class="bx bx-trash"></i></a>
                                  </td>
                                </tr>
                            @endforeach
                          </tbody>
                      </table>
                      {!! $paails->links() !!}
                  </div>
              </div>
          </div>
        </div> --}}

        <div class="col-xl-5">
            <div class="card mb-4">
                <div class="card-header pb-1 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Money Factor</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('store_settings') }}" method="POST">
                        @csrf
                        <div class="card-datatable">
                            <table class="datatables-basic table table-bordered text-nowrap">
                                <tbody>
                                    <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="svc399_years_monthly">SVC 3.99
                                              monthly</label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group">
                                            <input type="hidden" name="type[]" value="svc399_years_monthly">
                                            <input type="text" class="form-control form-control-sm text-end"
                                              value="{{ app_setting('svc399_years_monthly') }}"
                                              id="svc399_years_monthly" name="svc399_years_monthly" />
                                          </div>
                                      </td>
                                  </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="svc299_years_monthly">SVC 2.99
                                                monthly
                                            </label>
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group">
                                              <input type="hidden" name="type[]" value="svc299_years_monthly">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('svc299_years_monthly') }}"
                                                id="svc299_years_monthly" name="svc299_years_monthly" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="pace399">PACE 3.99</label>
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group">
                                                <table>
                                                  <tr>
                                                    <td>
                                                      <input type="hidden" name="type[]" value="pace399_1">
                                                      <input type="text" class="form-control form-control-sm text-end"
                                                          value="{{ app_setting('pace399_1') }}" id="pace399_1"
                                                          name="pace399_1" />
                                                    </td>
                                                    <td>
                                                      <input type="hidden" name="type[]" value="pace399_1_dealer_fee">
                                                      <input type="text" class="form-control form-control-sm text-end"
                                                          value="{{ app_setting('pace399_1_dealer_fee') }}" id="pace399_1_dealer_fee"
                                                          name="pace399_1_dealer_fee" placeholder="Dealer Fee"/>
                                                    </td>
                                                  </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="pace599">PACE 5.99</label>
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group">
                                                <table>
                                                  <tr>
                                                    <td>
                                                      <input type="hidden" name="type[]" value="pace599_1">
                                                      <input type="text" class="form-control form-control-sm text-end" value="{{ app_setting('pace599_1') }}" id="pace599_1"
                                                    name="pace599_1" />
                                                    </td>
                                                    <td>
                                                      <input type="hidden" name="type[]" value="pace599_1_dealer_fee">
                                                      <input type="text" class="form-control form-control-sm text-end" value="{{ app_setting('pace599_1_dealer_fee') }}" id="pace599_1_dealer_fee" name="pace599_1_dealer_fee" placeholder="Dealer Fee" />
                                                    </td>
                                                  </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="mosiac399">Mosiac 3.99 25 years</label>
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group">
                                              <input type="hidden" name="type[]" value="mosiac399">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('mosiac399') }}" id="mosiac399"
                                                name="mosiac399" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="sunlight_399_25Y">SUNLIGHT 3.99 25 YEARS</label>
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group">
                                              <input type="hidden" name="type[]" value="sunlight_399_25Y">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('sunlight_399_25Y') }}" id="sunlight_399_25Y"
                                                name="sunlight_399_25Y" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="mosiac399">SUNLIGHT 4.99 25 YEARS</label>
                                        </td>
                                        <td class="p-1">
                                            <div class="input-group">
                                              <input type="hidden" name="type[]" value="sunlight_499_25Y">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('sunlight_499_25Y') }}" id="sunlight_499_25Y"
                                                name="sunlight_499_25Y" />
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="pace399_after_tax_credit">PACE 3.99 after
                                                tax credit</label>
                                        </td>
                                        <td class="p-1">
                                            <input type="hidden" name="type[]" value="pace399_after_tax_credit">
                                            <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('pace399_after_tax_credit') }}"
                                                id="pace399_after_tax_credit" name="pace399_after_tax_credit" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="p-1">
                                            <label class="form-label col-6" for="pace599_after_tax_credit">PACE 5.99 after
                                                tax credit</label>
                                        </td>
                                        <td class="p-1">
                                            <input type="hidden" name="type[]" value="pace599_after_tax_credit">
                                            <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('pace599_after_tax_credit') }}"
                                                id="pace599_after_tax_credit" name="pace599_after_tax_credit" />
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-xl-5">
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-between align-items-center">
                  <h5 class="mb-0">Additional</h5> <small class="text-muted float-end"></small>
              </div>
              <div class="card-body">
                  <form action="{{ route('store_settings') }}" method="POST">
                      @csrf
                      <div class="card-datatable">
                          <table class="datatables-basic table table-bordered">
                              <tbody>
                                  <tr>
                                      <td class="p-1" style="min-width: 220px">Panel Upgrade</td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <span class="input-group-text">$</span>
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('panel_upgrade') }}" id="panel_upgrade"
                                                  name="panel_upgrade">
                                              <input type="hidden" name="type[]" value="panel_upgrade">
                                          </div>
                                      </td>
                                  </tr>
                                  {{-- <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="hvac_system">HVAC system</label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <span class="input-group-text">$</span>
                                              <input type="hidden" name="type[]" value="hvac_system">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('hvac_system') }}" id="hvac_system"
                                                  name="hvac_system" />
                                          </div>
                                      </td>
                                  </tr> --}}
                                  <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="connection_fee">Connection fee</label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <span class="input-group-text">$</span>
                                              <input type="hidden" name="type[]" value="connection_fee">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('connection_fee') }}" id="connection_fee"
                                                  name="connection_fee" />
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="line_conditioner">Line conditioner</label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <span class="input-group-text">$</span>
                                              <input type="hidden" name="type[]" value="line_conditioner">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('line_conditioner') }}" id="line_conditioner"
                                                  name="line_conditioner" />
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="tier2_insurance">Tier2 insurance</label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <span class="input-group-text">$</span>
                                              <input type="hidden" name="type[]" value="tier2_insurance">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('tier2_insurance') }}" id="tier2_insurance"
                                                  name="tier2_insurance" />
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="aeroseal">Aerosal savings</label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <input type="hidden" name="type[]" value="aeroseal">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('aeroseal') }}" id="aeroseal"
                                                  name="aeroseal" />
                                              <span class="input-group-text">%</span>
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td class="p-1">
                                          <label class="form-label col-6" for="actual_system_multiplied_by"><small>Aerosal price per watt</small></label>
                                      </td>
                                      <td class="p-1">
                                          <div class="input-group input-group-sm">
                                              <input type="hidden" name="type[]" value="actual_system_multiplied_by">
                                              <input type="text" class="form-control form-control-sm text-end"
                                                  value="{{ app_setting('actual_system_multiplied_by') }}" id="actual_system_multiplied_by"
                                                  name="actual_system_multiplied_by" />
                                          </div>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td class="p-1">
                                        <label class="form-label col-6" for="tonage_markup">Tonage Markup</label>
                                    </td>
                                    <td class="p-1">
                                        <div class="input-group input-group-sm">
                                            <input type="hidden" name="type[]" value="tonage_markup">
                                            <input type="text" class="form-control form-control-sm text-end"
                                                value="{{ app_setting('tonage_markup') }}" id="tonage_markup"
                                                name="tonage_markup" />
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </td>
                                </tr>

                              </tbody>
                          </table>
                      </div>
                      <button type="submit" class="btn btn-primary">Update</button>
                  </form>
              </div>
          </div>
         </div>

        <div class="col-xl-7">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Legends</h5><button class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addSolarProgramModal">Add Solar Program</button>
                </div>
                <div class="card-body p-0">
                    <div class="card-datatable">
                        <table class="datatables-basic table table-bordered yajra-datatable">
                            <thead>
                                <tr>
                                    <th>Solar Program</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add solar program --}}
    <div class="modal fade" id="addSolarProgramModal" tabindex="-1" aria-labelledby="addSolarProgramModalLabel"
        aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <form action="{{ route('solarprogram.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSolarProgramModalLabel">Add new solar program</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row append_new_solar_program">
                            <div class="mb-3 col-8">
                                <label class="form-label" for="name">Finance Program</label>
                                <input type="text" class="form-control text-uppercase" id="name" name="name" required/>
                            </div>
                            <div class="mb-3 col-4">
                                <div class="btn-group mt-4 float-end">
                                  <button type="button" class="add_program btn btn-primary">+</button>
                                </div>
                            </div>
                            <div class="col-12 border">
                                <div class="row">
                                    <div class="mb-3 col-3">
                                        <label class="form-label" for="interest_rate"><small>Interest Rate</small></label>
                                        <input type="text" class="form-control form-control-sm" id="interest_rate"
                                            name="intereset[]" required />
                                    </div>
                                    <div class="mb-3 col-2">
                                        <label class="form-label" for="year"><small>Year</small></label>
                                        <input type="text" class="form-control form-control-sm" id="year" name="year[]" required />
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label class="form-label" for="net_price"><small>Net Price(/Watt)</small></label>
                                        <input type="text" class="form-control form-control-sm" id="net_price" name="net_price[]" required/>
                                    </div>
                                    <div class="mb-3 col-3">
                                        <label class="form-label" for="dealer_fee"><small>Dealer Fee</small></label>
                                        <input type="text" class="form-control form-control-sm" id="dealer_fee" value="0" name="dealer_fee[]" required/>
                                    </div>
                                    <div class="mb-3 col-1 mt-4" style="margin-left: -17px">
                                          <button type="button" class="remove_program btn btn-sm btn-danger">-</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary text-white submit"
                            data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit solar program --}}
    <div class="modal fade" id="editSolarProgramModal" tabindex="-1"
        aria-labelledby="editSolarProgramModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

            </div>
        </div>
    </div>

    {{-- Add Finance --}}
    <div class="modal fade" id="addFinanceModal" tabindex="-1" aria-labelledby="addFinanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('finance.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFinanceModalLabel">Add new finance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label" for="finance">Finance</label>
                            <input type="text" class="form-control" id="finance" name="finance" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="Discount">Discount</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="Discount" name="discount" />
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="buttom" class="btn btn-primary text-white submit"
                            data-bs-dismiss="modal">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Finance --}}
    <div class="modal fade" id="editFinanceModal" tabindex="-1" aria-labelledby="editFinanceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

            </div>
        </div>
    </div>

    {{-- Remove finance --}}
    <div class="modal fade" id="deleteFinanceModal" data-delete_id="" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Finance</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete this Finance?</p>
                        @csrf
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger text-white ">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Add Brand --}}
    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="{{ route('brand.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addBrandModalLabel">Add new brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body pb-0">
                        <div class="mb-3">
                            <label class="form-label" for="name">Brand Name</label>
                            <input type="text" class="form-control" id="name" name="name" />
                        </div>
                        <div class="mb-3" id="tonage_append">
                            <div class="row">
                                <div class="col-4">
                                    <label class="form-label" for="Tonage">Tonage</label>
                                    <input type="text" class="form-control" id="Tonage" name="tonage[]"
                                        required />
                                </div>
                                <div class="col-4">
                                    <label class="form-label" for="Price">Price</label>
                                    <input type="text" class="form-control" id="Price" name="price[]" required />
                                </div>
                                <div class="col-2">
                                    <label for=""></label>
                                    <div class="btn-group">
                                        <button type="button"
                                            class="btn btn-primary append_tonage"><strong>+</strong></button>
                                        <button type="button"
                                            class="btn btn-danger remove_tonage"><strong>-</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Brand --}}
    <div class="modal fade" id="editBrandModal" tabindex="-1" aria-labelledby="editBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">

            </div>
        </div>
    </div>

    {{-- Remove brand --}}
    <div class="modal fade" id="deleteBrandModal" tabindex="-1" aria-labelledby="deleteBrandModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteBrandModalLabel">Delete Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure to delete this Brand?</p>
                        @csrf
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary text-white"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger text-white ">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('page-script')
    @include('vendor.datatable.scripts')
    <script>
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('solarprogram.index') }}",
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $("body").on("click", ".add_program", function() {
              var html = `
              <div class="col-12 border">
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label class="form-label" for="interest_rate"><small>Interest Rate</small></label>
                            <input type="text" class="form-control form-control-sm" id="interest_rate"
                                name="intereset[]" required />
                        </div>
                        <div class="mb-3 col-2">
                            <label class="form-label" for="year"><small>Year</small></label>
                            <input type="text" class="form-control form-control-sm" id="year" name="year[]" required />
                        </div>
                        <div class="mb-3 col-3">
                            <label class="form-label" for="net_price"><small>Net Price(/Watt)</small></label>
                            <input type="text" class="form-control form-control-sm" id="net_price" name="net_price[]" required/>
                        </div>
                        <div class="mb-3 col-3">
                            <label class="form-label" for="dealer_fee"><small>Dealer Fee</small></label>
                            <input type="text" class="form-control form-control-sm" id="dealer_fee" value="0" name="dealer_fee[]" required/>
                        </div>
                        <div class="mb-3 col-1 mt-4" style="margin-left: -17px">
                              <button type="button" class="remove_program btn btn-sm btn-danger">-</button>
                        </div>
                    </div>
                </div>
              `;
              $(".append_new_solar_program").append(html);
            })

            $("body").on("click", ".edited_add_program", function() {
              var html = `
              <div class="col-12 border">
                    <div class="row">
                        <div class="mb-3 col-3">
                            <label class="form-label" for="interest_rate"><small>Interest Rate</small></label>
                            <input type="text" class="form-control form-control-sm" id="interest_rate"
                                name="intereset[]" required />
                        </div>
                        <div class="mb-3 col-2">
                            <label class="form-label" for="year"><small>Year</small></label>
                            <input type="text" class="form-control form-control-sm" id="year" name="year[]" required />
                        </div>
                        <div class="mb-3 col-3">
                            <label class="form-label" for="net_price"><small>Net Price(/Watt)</small></label>
                            <input type="text" class="form-control form-control-sm" id="net_price" name="net_price[]" required/>
                        </div>
                        <div class="mb-3 col-3">
                            <label class="form-label" for="dealer_fee"><small>Dealer Fee</small></label>
                            <input type="text" class="form-control form-control-sm" id="dealer_fee" value="0" name="dealer_fee[]" required/>
                        </div>
                        <div class="mb-3 col-1 mt-4" style="margin-left: -17px">
                              <button type="button" class="remove_program btn btn-sm btn-danger">-</button>
                        </div>
                    </div>
                </div>
              `;
              $(".append_edited_solar_program").append(html);
            })

            $("body").on("click",".remove_program", function() {
              $(this).parent().parent().parent().remove();
            })

            $("#addSolarProgramModal form .submit").on('click', function(e) {
                e.preventDefault();
                var data = $("#addSolarProgramModal form").serialize();
                $.ajax({
                    url: "{{ route('solarprogram.store') }}",
                    type: "POST",
                    data: data,
                    success: function(data) {
                      $("#addSolarProgramModal form")[0].reset();
                        data.success == true ? notify('success', data.message) : notify('error',
                            data.message);
                        table.ajax.url("{{ route('solarprogram.index') }}").load();
                    },
                })
            })

            $("body").on("click", ".edit_solar_program", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('solarprogram.edit', ':id') }}";
                url = url.replace(":id", id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#editSolarProgramModal .modal-content").html(data);
                    }
                })
            })

            $("body").on('click', ".update_solar_program", function(e) {
                e.preventDefault();
                var data = $("#editSolarProgramModal form").serialize();
                $.ajax({
                    url: $("#editSolarProgramModal form").attr("action"),
                    type: "PUT",
                    data: data,
                    success: function(data) {
                      $("#editSolarProgramModal .modal-content").html("");
                        data.success == true ? notify('success', data.message) : notify('error',
                            data.message);
                        table.ajax.url("{{ route('solarprogram.index') }}").load();
                    },
                })
            })

            $("body").on("click", ".open_delete_modal", function() {
                var id = $(this).data('id');
                $("#deleteModal").attr('data-delete_id', id);
            })

            $("body").on("click", ".delete_btn", function() {
                var id = $("#deleteModal").data('delete_id');
                var url = "{{ route('customers.destroy', ':id') }}";
                url = url.replace(":id", id);
                $.ajax({
                    type: 'DELETE',
                    url: url,
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        data.success == true ? notify('success', data.message) : notify('error',
                            data.message);
                        table.ajax.url("{{ route('customers.index') }}").load();
                    }
                })
            })

            $("body").on("click", ".delete_finance", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('finance.destroy', ':id') }}";
                url = url.replace(":id", id);
                $("#deleteFinanceModal form").attr("action", url);
            })

            $("body").on("click", ".edit_finance", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('finance.edit', ':id') }}";
                url = url.replace(":id", id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#editFinanceModal .modal-content").html(data);
                    }
                })
            })

            $("body").on("click", ".remove_tonage", function() {
                $(this).parent().parent().parent().remove();
            })

            $("body").on("click", ".delete_brand", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('brand.destroy', ':id') }}";
                url = url.replace(":id", id);
                $("#deleteBrandModal form").attr("action", url);
            })

            $("body").on("click", ".edit_brand", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('brand.edit', ':id') }}";
                url = url.replace(":id", id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#editBrandModal .modal-content").html(data);
                    }
                });
            })

            $("body").on("click", ".append_tonage", function() {
                var html = `
                  <div class="row">
                    <div class="col-4">
                      <label class="form-label" for="Tonage">Tonage</label>
                      <input type="text" class="form-control" id="Tonage" name="tonage[]" required/>
                    </div>
                    <div class="col-4">
                      <label class="form-label" for="Price">Price</label>
                      <input type="text" class="form-control" id="Price" name="price[]" required/>
                    </div>
                    <div class="col-2">
                      <label for=""></label>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary append_tonage"><strong>+</strong></button>
                        <button type="button" class="btn btn-danger remove_tonage"><strong>-</strong></button>
                      </div>
                    </div>
                  </div>
                `;
                $("#tonage_append").append(html);
            })

            $("body").on("click", ".edit_tonage_append", function() {
                var html = `
                  <div class="row">
                    <div class="col-4">
                      <label class="form-label" for="Tonage">Tonage</label>
                      <input type="text" class="form-control" id="Tonage" name="tonage[]" required/>
                    </div>
                    <div class="col-4">
                      <label class="form-label" for="Price">Price</label>
                      <input type="text" class="form-control" id="Price" name="price[]" required/>
                    </div>
                    <div class="col-2">
                      <label for=""></label>
                      <div class="btn-group">
                        <button type="button" class="btn btn-primary edit_tonage_append"><strong>+</strong></button>
                        <button type="button" class="btn btn-danger remove_tonage"><strong>-</strong></button>
                      </div>
                    </div>
                  </div>
                `;
                $("#edit_tonage_append").append(html);
            })

            $("body").on("click", ".delete_paail", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('paail.destroy', ':id') }}";
                url = url.replace(":id", id);
                $("#deletepaailModal form").attr("action", url);
            })

            $("body").on("click", ".edit_paail", function() {
                var id = $(this).attr("data-id");
                var url = "{{ route('paail.edit', ':id') }}";
                url = url.replace(":id", id);
                $.ajax({
                    type: "GET",
                    url: url,
                    success: function(data) {
                        $("#editpaailModal .modal-content").html(data);
                    }
                })
            })
        });
    </script>
    <script></script>
@endsection
