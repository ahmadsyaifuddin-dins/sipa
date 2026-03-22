<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Laporan SIPA')</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-bold {
            font-weight: bold;
        }

        .mt-4 {
            margin-top: 20px;
        }

        .mb-2 {
            margin-bottom: 10px;
        }

        /* Style Tabel Utama DomPDF */
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            margin-bottom: 30px;
        }

        .table-data th,
        .table-data td {
            border: 1px solid #000;
            padding: 6px 8px;
        }

        .table-data th {
            background-color: #e5e7eb;
            text-transform: uppercase;
            font-size: 11px;
        }
    </style>
</head>

<body>

    @include('components.pdf._header')

    <div class="text-center mb-2">
        <h3 style="margin: 0; text-decoration: underline; text-transform: uppercase;">
            @yield('report_title')
        </h3>
        <p style="margin: 5px 0 0 0; font-size: 11px;">
            @yield('report_periode')
        </p>
    </div>

    @yield('content')

    @include('components.pdf._signature')

</body>

</html>
