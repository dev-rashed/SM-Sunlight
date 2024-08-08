<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
.text-center {
 text-align: center;   
}
th {
    padding: 7px 0px;
}
td {
    padding: 5px 0px;
}

td.name {
    padding: 5px 10px;
}
    </style>
</head>
<body>
    <h3 class="text-center">SM Sunlight Group</h3>
    <p class="text-center">{{ date('d-m-Y') }}</p>
    <table style="width:100%">
      <caption style="margin-top: 20px">Work Report</caption>
        <tr>
            <th>Name</th>
            <th>Today</th>
            <th>Yesterday</th>
            <th>Last Week</th>
            <th>Last Month</th>
            <th>Total</th>
        </tr>
        @php
            $daily_total = 0;
            $yesterday_total = 0;
            $lastweek_total = 0;
            $lastmonth_total = 0;
            $total = 0;
        @endphp
        @foreach($data as $i => $item)
            <tr>
                <td class="name">{{ $item['name'] }}</td>
                <td class="text-center">{{ $item['customers_today'] }} @php $daily_total = $daily_total + $item['customers_today'] @endphp</td>
                <td class="text-center">{{ $item['customers_yesterday'] }} @php $yesterday_total = $yesterday_total + $item['customers_yesterday'] @endphp</td>
                <td class="text-center">{{ $item['customers_this_week'] }} @php $lastweek_total = $lastweek_total + $item['customers_this_week'] @endphp</td>
                <td class="text-center">{{ $item['customers_this_month'] }} @php $lastmonth_total = $lastmonth_total + $item['customers_this_month'] @endphp</td>
                <td class="text-center">{{ $item['customers_lifetime'] }} @php $total = $total + $item['customers_lifetime'] @endphp</td>
            </tr>
        @endforeach
        <tr>
            <th>Total: </th>
            <th>{{ $daily_total }}</th>
            <th>{{ $yesterday_total }}</th>
            <th>{{ $lastweek_total }}</th>
            <th>{{ $lastmonth_total }}</th>
            <th>{{ $total }}</th>
        </tr>
    </table>
</body>
</html>
