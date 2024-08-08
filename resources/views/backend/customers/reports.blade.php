@extends('layouts/layoutMaster')

@section('title', 'Customers')

@section('content')
    <h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
        <div><span class="text-muted fw-light">Dashboard /</span> Reports</div>
        <span>
            <div class="btn-group">
                <a href="{{ route('customers.export-pdf') }}" class="btn btn-warning exportBtn">Export PDF</a>
            </div>
        </span>
    </h4>

    <div class="card">
        <div class="card-datatable table-responsive">
            <table class="datatables-basic table table-bordered yajra-datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th class="text-center">Report <br><small>(Today)</small></th>
                        <th class="text-center">Report <br><small>(Yesterday)</th>
                        <th class="text-center">Report <br><small>(Last Week)</th>
                        <th class="text-center">Report <br><small>(Last Month)</th>
                        <th class="text-center">Report <br><small>(Total)</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="2"><div class="text-center">Total : </div></th>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                        <td colspan=""></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" data-delete_id="" tabindex="-1" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete customer?</p>
                    @csrf
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary text-white" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger text-white delete_btn"
                        data-bs-dismiss="modal">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-style')
    @include('vendor.datatable.styles')
@endsection

@section('vendor-script')
    @include('vendor.datatable.scripts')
@endsection

@section('page-script')
    <script>
        $(function() {
            var table = $('.yajra-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('reports') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'today',
                        name: 'today'
                    },
                    {
                        data: 'yesterday',
                        name: 'yesterday'
                    },
                    {
                        data: 'last_week',
                        name: 'last_week'
                    },
                    {
                        data: 'last_month',
                        name: 'last_month'
                    },
                    
                    {
                        data: 'total',
                        name: 'total'
                    },
                    
                ],
                
                "drawCallback": function( settings ) {
                    var api = this.api();
                    var datas = api.rows( {page:'current'} ).data();
                    report_total = 0;
                    today_total = 0;
                    yesterday_total = 0;
                    last_week_total = 0;
                    last_month_total = 0;
                    $.each(datas, function(index, value) {
                        today_total = today_total + parseInt(value.customers_today);
                        yesterday_total = yesterday_total + parseInt(value.customers_yesterday);
                        last_week_total = last_week_total + parseInt(value.customers_this_week);
                        last_month_total = last_month_total + parseInt(value.customers_this_month);
                        report_total = report_total + parseInt(value.customers_lifetime);
                    });
                    
                    $("#DataTables_Table_0 tfoot td:nth-child(2)").html("<div class='text-center fw-bold fs-4'>"+today_total+"</div>");
                    $("#DataTables_Table_0 tfoot td:nth-child(3)").html("<div class='text-center fw-bold fs-4'>"+yesterday_total+"</div>");
                    $("#DataTables_Table_0 tfoot td:nth-child(4)").html("<div class='text-center fw-bold fs-4'>"+last_week_total+"</div>");
                    $("#DataTables_Table_0 tfoot td:nth-child(5)").html("<div class='text-center fw-bold fs-4'>"+last_month_total+"</div>");
                    $("#DataTables_Table_0 tfoot td:nth-child(6)").html("<div class='text-center fw-bold fs-4'>"+report_total+"</div>");
                }
            });

            $("body").on("click", ".open_delete_modal", function() {
                var id = $(this).data('id');
                $("#deleteModal").attr('data-delete_id', id);
            })

            $("body").on("click", ".delete_btn", function() {
                var id = $("#deleteModal").data('delete_id');
                var url = "{{ route('customers.destroy', ':id') }}";
                url = url.replace(":id", id);
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "id": id,
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    success: function(data) {
                      table.ajax.url("{{ route('customers.index') }}").load();
                      data.success == true ? notify('success', data.message) : notify('error',
                            data.message);
                    }
                })
            })
            
            $("body").on("click", ".exportBn", function() {
                $.ajax({
                    url: "{{ route('customers.export-pdf') }}",
                    type: 'GET',
                    success: function(response) {
                        window.open(response, '_blank');
                    }
                })
            })
        });
    </script>
@endsection
