@extends('layouts/layoutMaster')

@section('title', 'Add Home Visit Reports')

@section('content')

<style>
    .form-container {
        max-width: 800px;
        margin: auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .submit-btn {
        width: 100%;
        padding: 10px;
        font-size: 16px;
    }
</style>

<div class="container-fluid">
    <h4 class="py-3 breadcrumb-wrapper mb-4 d-flex justify-content-between">
        <div><span class="text-muted fw-light">Home Visit /</span> Report</div>
        <a href="{{ route('homevisitreport.index') }}" class="btn btn-primary">View Home Visit Report</a>
    </h4>

    <div class="form-container">
        <h1 class="text-center mb-4">Add Home Visit Report Form</h1>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('homevisitreport.store') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="serial_number" class="form-label">Serial Number:</label>
                        <input type="text" id="serial_number" name="serial_number" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="customer_name" class="form-label">Customer Name:</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="occupation" class="form-label">Occupation:</label>
                        <select id="occupation" name="occupation" class="form-select" required
                            onchange="toggleOtherInput()">
                            <option value="" disabled selected>Select an Occupation</option>
                            <option value="Farmer">Farmer</option>
                            <option value="Fisherman">Fisherman</option>
                            <option value="Teacher">Teacher</option>
                            <option value="Professor">Professor</option>
                            <option value="Lecturer">Lecturer</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Nurse">Nurse</option>
                            <option value="Pharmacist">Pharmacist</option>
                            <option value="Dentist">Dentist</option>
                            <option value="Engineer">Engineer</option>
                            <option value="Business">Business</option>
                            <option value="Politician">Politician</option>
                            <option value="Journalist">Journalist</option>
                            <option value="Manager">Manager</option>
                            <option value="Accountant">Accountant</option>
                            <option value="Sales Representative">Sales Representative</option>
                            <option value="Banker">Banker</option>
                            <option value="Police Officer">Police Officer</option>
                            <option value="Army Officer">Army Officer</option>
                            <option value="Navy Officer">Navy Officer</option>
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
                            <option value="Imam">Imam</option>
                            <option value="Moajjem">Moajjem</option>
                            <option value="Housewife">Housewife</option>
                            <option value="Other">Other</option>
                        </select>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile_number" class="form-label">Mobile Number (Unique):</label>
                        <input type="text" id="mobile_number" name="mobile_number" class="form-control" required
                            minlength="11" maxlength="11" pattern="\d{11}" title="Please enter exactly 11 digits"
                            value="01">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="village_name" class="form-label">Village Name:</label>
                        <input type="text" id="village_name" name="village_name" class="form-control" required>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="word_number" class="form-label">Word Number:</label>
                        <select id="word_number" name="word_number" class="form-select" required>
                            <option value="" disabled selected>Select a Word Number</option>
                            @for ($i = 1; $i <= 9; $i++)
                                <option value="{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}">
                                    {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="union_name" class="form-label">Union Name:</label>
                        <select id="union_name" name="union_name" class="form-select" required>
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
                            <option value="Ashanganj">Ashanganj</option>
                            <option value="Bhonpara">Bhonpara</option>
                            <option value="Bisha">Bisha</option>
                            <option value="Hatkalupara">Hatkalupara</option>
                            <option value="Kalikapur">Kalikapur</option>
                            <option value="Maniari">Maniari</option>
                            <option value="Panchupur">Panchupur</option>
                            <option value="Sahagola">Sahagola</option>
                            <option value="Bahadurpur">Bahadurpur</option>
                            <option value="Bhabicha">Bhabicha</option>
                            <option value="Chandan_Nagar">Chandan_Nagar</option>
                            <option value="Hajinagar">Hajinagar</option>
                            <option value="Niamatpur">Niamatpur</option>
                            <option value="Parail">Parail</option>
                            <option value="Rasulpur">Rasulpur</option>
                            <option value="Sreemantapur">Sreemantapur</option>
                            <option value="Bakshimail">Bakshimail</option>
                            <option value="Dhurail">Dhurail</option>
                            <option value="Ghasigram">Ghasigram</option>
                            <option value="Jahanabad">Jahanabad</option>
                            <option value="Maugachhi">Maugachhi</option>
                            <option value="Rayghati">Rayghati</option>
                            <option value="Badhair">Badhair</option>
                            <option value="Chanduria">Chanduria</option>
                            <option value="Kalma">Kalma</option>
                            <option value="Kamargaon">Kamargaon</option>
                            <option value="Pachandar">Pachandar</option>
                            <option value="Saranjai">Saranjai</option>
                            <option value="Talanda">Talanda</option>
                            <option value="Auchpara">Auchpara</option>
                            <option value="Basupara">Basupara</option>
                            <option value="Borobihanoli">Borobihanoli</option>
                            <option value="Dippur">Dippur</option>
                            <option value="Ganipur">Ganipur</option>
                            <option value="Gobindapara">Gobindapara</option>
                            <option value="Gualkandi">Gualkandi</option>
                            <option value="Hamirkutsa">Hamirkutsa</option>
                            <option value="Jogipara">Jogipara</option>
                            <option value="Kacharikoalipara">Kacharikoalipara</option>
                            <option value="Maria">Maria</option>
                            <option value="Nordas">Nordas</option>
                            <option value="Sonadanaga">Sonadanaga</option>
                            <option value="Sreepur">Sreepur</option>
                            <option value="Suvodanga">Suvodanga</option>
                            <option value="Zhikra">Zhikra</option>
                            <option value="Bhimpur">Bhimpur</option>
                            <option value="Chandas">Chandas</option>
                            <option value="Cheragpur">Cheragpur</option>
                            <option value="Enayetpur">Enayetpur</option>
                            <option value="Hatur">Hatur</option>
                            <option value="Khajur">Khajur</option>
                            <option value="Mahadevpur">Mahadevpur</option>
                            <option value="Raigaon">Raigaon</option>
                            <option value="Safapur">Safapur</option>
                            <option value="Uttargram">Uttargram</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="thana" class="form-label">Thana:</label>
                        <select id="thana" name="thana" class="form-select" required>
                            <option value="" disabled selected>Select a Thana</option>
                            <option value="Manda">Manda</option>
                            <!-- <option value="Atrai">Atrai</option> -->
                            <!-- <option value="Dhamoirhat">Dhamoirhat</option> -->
                            <!-- <option value="Badalgachhi">Badalgachhi</option> -->
                            <option value="Niamatpur">Niamatpur</option>
                            <option value="Mohadevpur">Mohadevpur</option>
                            <!-- <option value="Patnitala">Patnitala</option> -->
                            <!-- <option value="Porsha">Porsha</option> -->
                            <!-- <option value="Sapahar">Sapahar</option> -->
                            <!-- <option value="Raninagar">Raninagar</option> -->
                            <option value="Bagmara">Bagmara</option>
                            <option value="Mohanpur">Mohanpur</option>
                            <option value="Tanore">Tanore</option>
                            <!-- <option value="Paba">Paba</option> -->
                            <!-- <option value="Naogaon">Naogaon</option> -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="district" class="form-label">District:</label>
                        <select id="district" name="district" class="form-select" required>
                            <option value="" disabled selected>Select a District</option>
                            <option value="Naogaon">Naogaon</option>
                            <option value="Rajshahi">Rajshahi</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="home_appliance_have" class="form-label">Home Appliance Have:</label>
                        <textarea id="home_appliance_have" name="home_appliance_have" class="form-control"
                            required>IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="home_appliance_not_have" class="form-label">Home Appliance Don't Have:</label>
                        <textarea id="home_appliance_not_have" name="home_appliance_not_have"
                            class="form-control">IPS Machine, IPS Battery, EV, ER, Solar Panel, Solar Battery, CC Camera</textarea>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="remarks" class="form-label">Remarks:</label>
                        <textarea id="remarks" name="remarks" class="form-control"></textarea>
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection