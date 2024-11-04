@extends('layouts/layoutMaster')

@section('title', 'Institute Visit Reports')

@section('content')

<style>
    .table-container {
        overflow-x: auto;
    }

    th {
        background-color: #f4f4f4;
        white-space: nowrap;
    }
</style>

<h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
    <div><span class="text-muted fw-light">Institute Visit /</span> Report</div>
    <a href="{{ route('institutevisitreport.create') }}" class="btn btn-primary">Add Institute Visit Report</a>
</h4>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <h1 class="text-center mb-4">Institute Visit Reports</h1>

    <div class="table-container">
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-primary">
                <tr>
                    <th>Serial Number</th>
                    <th>Institute Name</th>
                    <th>Location</th>
                    <th>Teacher's Name</th>
                    <th>Teacher's Mobile</th>
                    <th>Teacher's Quantity</th>
                    <th>Student's Quantity</th>
                    <th>Home Appliance Have</th>
                    <th>Home Appliance Don't Have</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($instituteVisitReport as $report)
                    <tr>
                        <td>{{ $report->serial_number }}</td>
                        <td>{{ $report->institute_name }}</td>
                        <td>{{ $report->institute_location }}</td>
                        <td>{{ $report->teachers_name }}</td>
                        <td>{{ $report->teachers_mobile_number }}</td>
                        <td>{{ $report->teachers_quantity }}</td>
                        <td>{{ $report->students_quantity }}</td>
                        <td>{{ $report->home_appliance_have_f }}</td>
                        <td>{{ $report->home_appliance_not_have_f }}</td>
                        <td>{{ $report->remarks }}</td>
                        <td>{{ $report->created_at }}</td>
                        <td>{{ $report->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection