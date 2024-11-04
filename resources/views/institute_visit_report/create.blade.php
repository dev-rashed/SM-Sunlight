@extends('layouts/layoutMaster')

@section('title', 'Add Institute Visit Reports')

@section('content')

<style>
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
</style>

<h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
    <div><span class="text-muted fw-light">Institute Visit /</span> Report</div>
    <a href="{{ route('institutevisitreport.index') }}" class="btn btn-primary">View Institute Visit Report</a>
</h4>

<div class="container">
    <div class="form-container">
        <h1>Add Institute Visit Report Form</h1>

        <form action="{{ route('institutevisitreport.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="institute_name" class="form-label">Institute Name:</label>
                <input type="text" id="institute_name" name="institute_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="institute_location" class="form-label">Institute Location:</label>
                <input type="text" id="institute_location" name="institute_location" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="teachers_name" class="form-label">Teacher's Name:</label>
                <input type="text" id="teachers_name" name="teachers_name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="teachers_mobile_number" class="form-label">Teacher's Mobile Number (Unique):</label>
                <input type="text" id="teachers_mobile_number" name="teachers_mobile_number" class="form-control"
                    required minlength="11" maxlength="11" pattern="\d{11}" title="Please enter exactly 11 digits">
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="teachers_quantity" class="form-label">Teacher's Quantity:</label>
                    <input type="number" id="teachers_quantity" name="teachers_quantity" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="students_quantity" class="form-label">Student's Quantity:</label>
                    <input type="number" id="students_quantity" name="students_quantity" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="home_appliance_have_f" class="form-label">Home Appliance Have:</label>
                <textarea id="home_appliance_have_f" name="home_appliance_have_f" class="form-control"
                    required>IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
            </div>

            <div class="mb-3">
                <label for="home_appliance_not_have_f" class="form-label">Home Appliance Don't Have:</label>
                <textarea id="home_appliance_not_have_f" name="home_appliance_not_have_f"
                    class="form-control">IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
            </div>

            <div class="mb-3">
                <label for="remarks" class="form-label">Remarks:</label>
                <textarea id="remarks" name="remarks" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
    </div>
</div>

@endsection