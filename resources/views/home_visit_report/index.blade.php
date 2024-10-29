@extends('layouts/layoutMaster')

@section('title', 'Home Visit Reports')

@section('content')




    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            padding: 0px;
            margin: 0px;
        }
        table, th, td {
            border: 1px solid black;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }

        .search-form-container {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        margin-bottom: 20px;
        margin-top:-50px ;
    }

    .search-form-container .form-group {
        display: flex;
        align-items: center;
    }

    .search-form-container input[type="search"] {
        width: 200px;
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 5px 10px;
        margin-right: 5px;
    }

    .search-form-container button {
        border-radius: 4px;
        padding: 6px 12px;
    }

    @media (max-width: 768px) { /* Adjust max-width as needed for specific screen sizes */
        .hide-on-mobile {
            display: none;
        }
    }


    </style>




    <h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
        <div><span class="text-muted fw-light">Home Visit /</span> Report</div>
        <a href="{{ route('homevisitreport.create') }}" class="btn btn-primary">Add Home Visit Report</a>
    </h4>
    

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

<!-- hided on Mobile -->
    <h4 class="hide-on-mobile">Home Visit Reports</h4>
    <br>
    
    <!-- Search Form -->

    <!-- <form action="" class="col-md-2">
        <div class="form-group">
            <input type="search" name="search" class="form-control" placeholder="Search by name or number" value="{{ request('search') }}">
            <button class="btn btn-primary">Search</button>
        </div>
    </form> -->


    <div class="search-form-container">
    <form action="{{ route('homevisitreport.index') }}" method="GET">
        <div class="form-group">
            <input type="search" name="search" class="form-control" placeholder="Search by name or number" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
    </form>
    </div>


<div class="card">
    <div class="card-datatable table-responsive">
        <table class="datatables-basic table table-bordered yajra-datatable">
            <thead>
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
    <br>

    <div class="row">
    {{ $homeVisitReports->links() }}
    </div>
    <br>
    </div>
</div>
@endsection


