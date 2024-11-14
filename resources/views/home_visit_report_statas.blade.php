@extends('layouts/layoutMaster')

@section('title', 'Home Visit Report Statistics')

@section('content')
<div class="container-fluid">

    <h4 class="py-3 breadcrumb-wrapper mb-4 text-center">Md. Abdur Rahim Data</h4>
    <div style="text-align: end;"><a href="{{ route('home_visit_report.exportPdf') }}"
            class="btn btn-primary mb-3 ">Export
            to PDF</a>
    </div>

    <div class="card">
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Time Period</th>
                        <th>Total Submissions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Today</td>
                        <td>{{ $todayCount }}</td>
                    </tr>
                    <tr>
                        <td>Yesterday</td>
                        <td>{{ $yesterdayCount }}</td>
                    </tr>
                    <tr>
                        <td>Last Week</td>
                        <td>{{ $lastWeekCount }}</td>
                    </tr>
                    <tr>
                        <td>Last Month</td>
                        <td>{{ $lastMonthCount }}</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>{{ $totalCount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection