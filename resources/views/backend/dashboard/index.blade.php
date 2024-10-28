
@extends('layouts/layoutMaster')

@section('title', 'Dashboard')

@section('vendor-style')
{{-- <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}" /> --}}
@endsection

@section('vendor-script')
{{-- <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script> --}}
@endsection

@section('content')
<h2 class="text-center">Welcome to {{app_setting('appname')}}</h2>


<p style="text-align:center; padding-top:4%; ">
    
    <img src="/app_assets/658f671d90354.png" alt="Always Good For Everyone!" width="40%" height="">
    
</p>


<marquee behavior="scroll" direction="left" scrollamount="10" style="color:#0E56A1; font-weight: bold; font-size:22px;   padding: 15px; border-radius: 5px; margin-top: 20px;">Sunlight Battery House   ( সানলাইট ব্যাটারি হাউস )  |  Mayer Doa Battery House & IPS ( মায়ের দোয়া ব্যাটারী হাউস এন্ড আই.পি.এস )   |   Sunlight Battery & IPS  ( সানলাইট ব্যাটারী এন্ড আই.পি.এস  )  । Rangdhanu Battery House ( রংধনু ব্যাটারী হাউস )
</marquee>




    {{-- <div class="row">
      <div class="col-sm-3 col-6 mb-4">
        <div class="card">
          <div class="card-body text-center">
            <h2 class="mb-1">Applications</h2>
            <span class="text-muted">Total : </span>
            <div id="referralLineChart"></div>
          </div>
        </div>
      </div>
    </div> --}}
@endsection

@section('page-script')
{{-- <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script> --}}



<script>
'use strict';

</script>
@endsection



































