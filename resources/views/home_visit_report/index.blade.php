@extends('layouts/layoutMaster')

@section('title', 'Home Visit Reports')

@section('content')




    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>




    <h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
        <div><span class="text-muted fw-light">Home Visit /</span> Report</div>
        <a href="{{ route('homevisitreport.create') }}" class="btn btn-primary">Add Home Visit Report</a>
    </h4>
    

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

<div class="container">
    <h1>Home Visit Reports</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Serial Number</th>
                <th>Customer Name</th>
                <th>Mobile Number</th>
                <th>Village Name</th>
                <th>Word Number</th>
                <th>Union Name</th>
                <th>Thana</th>
                <th>District</th>
                <th>Home Appliance Have</th>
                <th>Home Appliance Don't Have</th>
                <th>Remarks</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($homeVisitReports as $report)
            <tr>
                <td>{{ $report->serial_number }}</td>
                <td>{{ $report->customer_name }}</td>
                <td>{{ $report->mobile_number }}</td>
                <td>{{ $report->village_name }}</td>
                <td>{{ $report->word_number }}</td>
                <td>{{ $report->union_name }}</td>
                <td>{{ $report->thana }}</td>
                <td>{{ $report->district }}</td>
                <td>{{ $report->home_appliance_have }}</td>
                <td>{{ $report->home_appliance_not_have }}</td>
                <td>{{ $report->remarks }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection


