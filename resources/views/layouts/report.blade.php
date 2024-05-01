@props(['date_start', 'date_end', 'colspan'])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@stack('title')</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        tbody {
            font-size: 12px;
        }

        tfoot {
            font-size: 12px;
            font-weight: 800;
        }

        th,
        td {
            padding: 3px;
        }

        tbody tr {
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
        }

        .header {
            font-size: 22px;
            gap: 10px;
            padding: 0px;
            border-bottom: 1px solid black;
            text-align: left;
        }

        .header img,
        .header span {
            vertical-align: middle;
        }

        .head {
            border-top: 1px solid #ccc;
        }

        .dates {
            text-align: center;
            font-weight: 400;
            padding-bottom: 10px;
        }

        th {
            text-align: left;
        }

        .title {
            text-align: center;
            font-size: 22px;
            padding-bottom: 0px;
            padding-top: 5px;
        }

        @page {
            margin: 0.5cm 1.27cm 1.27cm 1.27cm;
        }
    </style>

</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="{{ $colspan }}" class="header">
                    <img src="logo/favicon.png" alt="logo panadería San Xavier" width="30">
                    <span>San Xavier</span>
                </th>
            </tr>
            <tr>
                <th colspan="{{ $colspan }}" class="title">@stack('title')
                </th>
            </tr>
            <tr>
                @php
                    $date_start_formatted = date('d/m/Y', strtotime($date_start));
                    $date_end_formatted = date('d/m/Y', strtotime($date_end));
                @endphp
                <th colspan="{{ $colspan }}" class="dates">
                    {{ "Desde $date_start_formatted hasta $date_end_formatted" }}
                </th>
            </tr>
            <tr class="head">
                {{ $head }}
            </tr>
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
        <tfoot>
            {{ $footer ?? '' }}
        </tfoot>
    </table>
</body>

</html>
