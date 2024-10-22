@extends('layouts/layoutMaster')

@section('title', 'Add Institute Visit Reports')

@section('content')


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: #333;
    }
    .form-container {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        font-weight: bold;
        display: block;
        margin-bottom: 5px;
        color: #555;
    }
    .form-group input,
    .form-group textarea {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    .form-group textarea {
        height: 100px;
    }
    .submit-btn {
        display: block;
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        font-size: 16px;
        font-weight: bold;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .submit-btn:hover {
        background-color: #0056b3;
    }
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #007bff;
    }
</style>


<h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
        <div><span class="text-muted fw-light">Institute Visit /</span> Report</div>
        <a href="{{ route('institutevisitreport.index') }}" class="btn btn-primary">View Institute Visit Report</a>
</h4>


<div class="container">
    <h1>Add Institute Visit Report Form</h1>

    <form action="{{ route('institutevisitreport.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="institute_name">Institute Name:</label>
            <input type="text" id="institute_name" name="institute_name" required>
        </div>

        <div class="form-group">
            <label for="institute_location">Institute Location:</label>
            <input type="text" id="institute_location" name="institute_location" required>
        </div>

        <div class="form-group">
            <label for="teachers_name">Teacher's Name:</label>
            <input type="text" id="teachers_name" name="teachers_name" required>
        </div>

        <div class="form-group">
            <label for="teachers_mobile_number">Teacher's Mobile Number (Unique):</label>
            <input type="text" id="teachers_mobile_number" name="teachers_mobile_number" required>
        </div>

        <div class="form-group">
            <label for="teachers_quantity">Teacher's Quantity:</label>
            <input type="number" id="teachers_quantity" name="teachers_quantity" required>
        </div>

        <div class="form-group">
            <label for="students_quantity">Student's Quantity:</label>
            <input type="number" id="students_quantity" name="students_quantity" required>
        </div>

        <div class="form-group">
            <label for="home_appliance_have">Home Appliance Have:</label>
            <textarea id="home_appliance_have" name="home_appliance_have"  required >IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
        </div>

        <div class="form-group">
            <label for="home_appliance_not_have">Home Appliance Don't Have:</label>
            <textarea id="home_appliance_not_have" name="home_appliance_not_have">IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
        </div>

        <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
