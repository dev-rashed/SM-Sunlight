@extends('layouts/layoutMaster')

@section('title', 'Add Home Visit Reports')

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
        <div><span class="text-muted fw-light">Home Visit /</span> Report</div>
        <a href="{{ route('homevisitreport.index') }}" class="btn btn-primary">View Home Visit Report</a>
</h4>


<div class="row">
  <div class="col">
    <div class="card mb-3 p-3">
      <div class="row g-3">
<div class="form-container">
    <h1>Add Home Visit Report Form</h1>
    <form action="{{ route('homevisitreport.store') }}" method="POST">
        @csrf
        
        
<div class="row">
  <div class="col">
    <div class="card mb-3 p-3">
      <div class="row g-3">
          <div class="col-md-6">
                <div class="form-group">
                    <label for="serial_number">Serial Number:</label>
                    <input type="text" id="serial_number" name="serial_number"  required>
                </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name"  required>
            </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <div class="form-group">
            <label for="occupation">Occupation Name:</label>
            <select id="occupation" name="occupation" required>
                <option value="" disabled selected>Select an Occupation</option>
                <option value="Farmer">Farmer </option>
                <option value="Fisherman">Fisherman </option>
                <option value="Teacher">Teacher </option>
                <option value="Professor">Professor </option>
                <option value="Lecturer">Lecturer </option>
                <option value="Doctor">Doctor </option>
                <option value="Nurse">Nurse </option>
                <option value="Pharmacist">Pharmacist </option>
                <option value="Dentist">Dentist </option>
                <option value="Engineer">Engineer </option>
                <option value="Business">Business </option>
                <option value="Politician">Politician </option>
                <option value="Journalist">Journalist </option>
                <option value="Manager">Manager </option>
                <option value="Accountant">Accountant </option>
                <option value="Sales Representative">Sales Representative </option>
                <option value="Banker">Banker </option>
                <option value="Police Officer">Police Officer </option>
                <option value="Army Officer">Army Officer </option>
                <option value="Navy Officer">Navy Officer </option>
                <option value="Mechanic">Mechanic</option>
                <option value="Tailor">Tailor</option>
                <option value="Driver">Driver</option>
                <option value="Electrician">Electrician</option>
                <option value="Construction Worker">Construction Worker</option>
                <option value="Writer">Writer</option>
                <option value="Shopkeeper">Shopkeeper</option>
                <option value="Labour">Labour</option>
                <option value="Lawyer">Lawyer</option>
                <option value="Security Guard">Security Guard</option>
                <option value="Other">Other</option>
            </select>
        </div>
        </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label for="mobile_number">Mobile Number (Unique):</label>
            <input type="text" id="mobile_number" name="mobile_number"  required value="01">
        </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
            <label for="village_name">Village Name:</label>
            <input type="text" id="village_name" name="village_name" required>
            </div>
          </div>
          <div class="col-md-6">
          <div class="form-group">
            <label for="word_number">Word Number:</label>
            <select id="word_number" name="word_number" required>
                <option value="" disabled selected>Select a Union</option>
                <option value="01" selected >01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
            </select>
            </div>
        </div>          
        <div class="col-md-6">
        <div class="form-group">
            <label for="union_name">Union Name:</label>
            <select id="union_name" name="union_name" required>
                <option value="" disabled selected>Select a Union</option>
                <option value="Bhalain">Bhalain</option>
                <option value="Bharso">Bharso</option>
                <option value="Bishnupur">Bishnupur</option>
                <option value="Ganeshpur">Ganeshpur</option>
                <option value="Kalikapur">Kalikapur</option>
                <option value="Kansopara">Kansopara</option>
                <option value="Kashab">Kashab</option>
                <option value="Kusumba" selected>Kusumba</option>
                <option value="Manda">Manda</option>
                <option value="Moinam">Moinam</option>
                <option value="Nurullabad">Nurullabad</option>
                <option value="Paranpur">Paranpur</option>
                <option value="Proshadpur">Proshadpur</option>
                <option value="Tentulia">Tentulia</option>
            </select>
        </div>
        </div>        
        
        <div class="col-md-6">
        <div class="form-group">
            <label for="thana">Thana:</label>
            <select id="thana" name="thana" required>
                <option value="" disabled selected>Select a Union</option>
                <option value="Manda" selected >Manda</option>
                <option value="Naogaon">Naogaon</option>
            </select>
        </div>
        </div>        

        <div class="col-md-6">
        <div class="form-group">
            <label for="district">District:</label>
            <select id="district" name="district" required>
                <option value="" disabled selected>Select a Union</option>
                <option value="Naogaon" selected >Naogaon</option>
            </select>
        </div>
        </div>

        <div class="col-md-12">
        <div class="form-group">
            <label for="home_appliance_have">Home Appliance Have:</label>
            <textarea id="home_appliance_have" name="home_appliance_have"  required >IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
        </div>
        </div>

        <div class="col-md-12">
        <div class="form-group">
            <label for="home_appliance_not_have">Home Appliance Don't Have:</label>
            <textarea id="home_appliance_not_have" name="home_appliance_not_have">IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
        </div>
        </div>

        <div class="col-md-12">
        <div class="form-group">
            <label for="remarks">Remarks:</label>
            <textarea id="remarks" name="remarks"></textarea>
        </div>
        </div>


      <div class="row">
         <div class="col-12 px-0">
            <button type="submit" class="submit-btn">Submit</button>
         </div>
      </div>
    </div>
  </div>
</div>

























    </form>
</div>
</div>
</div>






@endsection
