@extends('pdf.layout')

@section('title', 'Laporan Penjualan Harian')
@section('report_title', 'LAPORAN PENJUALAN HARIAN')
@section('report_periode', 'Tanggal: ' . \Carbon\Carbon::parse($tanggal)->translatedFormat('d F Y'))

@section('content')
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%">No. Invoice</th>
                <th width="20%">Waktu</th>
                <th width="25%">Kasir</th>
                <th width="30%" class="text-right">Total Transaksi</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($transactions as $index => $trx)
                @php $grandTotal += $trx->total_harga; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $trx->invoice_no }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trx->created_at)->format('H:i') }} WITA</td>
                    <td>{{ $trx->user->name }}</td>
                    <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada transaksi pada tanggal ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right font-bold">TOTAL PENDAPATAN HARIAN</td>
                <td class="text-right font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
