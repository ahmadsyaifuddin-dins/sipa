<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran - {{ $transaction->invoice_no }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            color: #333;
        }

        .invoice-info {
            margin-bottom: 20px;
            width: 100%;
            border-collapse: collapse;
        }

        .invoice-info td {
            padding: 3px 0;
        }

        .table-items {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-items th,
        .table-items td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .table-items th {
            background-color: #f3f4f6;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }
    </style>
</head>

<body>

    @include('components.pdf._header')

    <h3 style="text-align: center; margin-bottom: 20px; text-decoration: underline;">BUKTI PEMBAYARAN</h3>

    <table class="invoice-info">
        <tr>
            <td width="15%"><strong>No. Invoice</strong></td>
            <td width="2%">:</td>
            <td width="33%">{{ $transaction->invoice_no }}</td>
            <td width="15%"><strong>Kasir</strong></td>
            <td width="2%">:</td>
            <td width="33%">{{ $transaction->user->name }}</td>
        </tr>
        <tr>
            <td><strong>Tanggal</strong></td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y H:i') }} WITA</td>
            <td colspan="3"></td>
        </tr>
    </table>

    <table class="table-items">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="45%">Nama Item (Barang / Jasa)</th>
                <th width="15%" class="text-center">Harga</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="25%" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaction->details as $index => $detail)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $detail->item->nama }}</td>
                    <td class="text-center">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right"><strong>Total Bayar</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($transaction->total_harga, 0, ',', '.') }}</strong>
                </td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Uang Tunai</td>
                <td class="text-right">Rp {{ number_format($transaction->bayar, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Kembali</td>
                <td class="text-right">Rp {{ number_format($transaction->kembali, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @include('components.pdf._signature')

</body>

</html>
