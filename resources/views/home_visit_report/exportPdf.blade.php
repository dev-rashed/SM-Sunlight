<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        table,
        th,
        td {
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
    <p style="margin-top: 20px; text-align: center">Home Visit Report Abdur Rahim Data</p>
    <table style="width:100%">
        <tr>
            <th>Name</th>
            <th>Today</th>
            <th>Yesterday</th>
            <th>Last Week</th>
            <th>Last Month</th>
            <th>Total</th>
        </tr>

        @php
            $todayCount = 0;
            $yesterdayCount = 0;
            $lastWeekCount = 0;
            $lastMonthCount = 0;
            $totalCount = 0;
        @endphp

        @foreach($data1 as $item)
            <tr>
                <td class="name">{{ $item['name'] }}</td>
                <td class="text-center">{{ $item['homeVisitReport_today'] }}
                    @php    $todayCount += $item['homeVisitReport_today'] @endphp
                </td>
                <td class="text-center">{{ $item['homeVisitReport_yesterday'] }}
                    @php    $yesterdayCount += $item['homeVisitReport_yesterday'] @endphp
                </td>
                <td class="text-center">{{ $item['homeVisitReport_this_week'] }}
                    @php    $lastWeekCount += $item['homeVisitReport_this_week'] @endphp
                </td>
                <td class="text-center">{{ $item['homeVisitReport_this_month'] }}
                    @php    $lastMonthCount += $item['homeVisitReport_this_month'] @endphp
                </td>
                <td class="text-center">{{ $item['homeVisitReport_lifetime'] }}
                    @php    $totalCount += $item['homeVisitReport_lifetime'] @endphp
                </td>
            </tr>
        @endforeach

        <tr>
            <th>Total:</th>
            <th>{{ $todayCount }}</th>
            <th>{{ $yesterdayCount }}</th>
            <th>{{ $lastWeekCount }}</th>
            <th>{{ $lastMonthCount }}</th>
            <th>{{ $totalCount }}</th>
        </tr>
    </table>

</body>

</html>