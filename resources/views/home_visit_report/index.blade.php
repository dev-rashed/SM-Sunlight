@extends('layouts/layoutMaster')

@section('title', 'Home Visit Reports')

@section('content')

<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid #dee2e6;
        text-align: left;
    }

    th {
        background-color: #f8f9fa;
    }

    .search-form-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 20px;
    }

    .hide-on-mobile {
        display: block;
    }

    @media (max-width: 768px) {
        .hide-on-mobile {
            display: none;
        }
    }
</style>

<div class="container-fluid">
    <h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between align-items-center">
        <div><span class="text-muted fw-light">Home Visit /</span> Report</div>
        <a href="{{ route('homevisitreport.create') }}" class="btn btn-primary">Add Home Visit Report</a>
    </h4>

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <!-- Page Title for larger screens -->
    <h4 class="hide-on-mobile">Home Visit Reports</h4>

    <!-- Search Form -->
    <div class="search-form-container mb-3">
        <form action="{{ route('homevisitreport.index') }}" method="GET" class="d-flex">
            <input type="search" name="search" class="form-control me-2" placeholder="Search by name or number"
                value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>

    <!-- Reports Table -->
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover yajra-datatable">
                <thead class="table-light">
                    <tr>
                        <th>Serial Number</th>
                        <th>Customer Name</th>
                        <th>Occupation</th>
                        <th>Mobile Number</th>
                        <th>Village Name</th>
                        <th>Word Number</th>
                        <th>Union Name</th>
                        <th>Thana</th>
                        <th>District</th>
                        <th>Home Appliance Have</th>
                        <th>Home Appliance Don't Have</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($homeVisitReports as $report)
                        <tr>
                            <td>{{ $report->serial_number }}</td>
                            <td>{{ $report->customer_name }}</td>
                            <td>{{ $report->occupation }}</td>
                            <td>{{ $report->mobile_number }}</td>
                            <td>{{ $report->village_name }}</td>
                            <td>{{ $report->word_number }}</td>
                            <td>{{ $report->union_name }}</td>
                            <td>{{ $report->thana }}</td>
                            <td>{{ $report->district }}</td>
                            <td>{{ $report->home_appliance_have }}</td>
                            <td>{{ $report->home_appliance_not_have }}</td>
                            <td>{{ $report->remarks }}</td>
                            <td>{{ $report->created_at }}</td>
                            <td>{{ $report->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        {{ $homeVisitReports->links() }}
    </div>
</div>

@endsection