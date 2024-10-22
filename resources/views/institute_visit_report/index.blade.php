@extends('layouts/layoutMaster')

@section('title', 'Institute Visit Reports')

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
        <div><span class="text-muted fw-light">Institute Visit /</span> Report</div>
        <a href="{{ route('institutevisitreport.create') }}" class="btn btn-primary">Add Institute Visit Report</a>
    </h4>
<div class="container">
    <h1>Institute Visit Reports</h1>

    <table class="table">
        <thead>
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
                    <td>{{ $report->home_appliance_have }}</td>
                    <td>{{ $report->home_appliance_dont_have }}</td>
                    <td>{{ $report->remarks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
