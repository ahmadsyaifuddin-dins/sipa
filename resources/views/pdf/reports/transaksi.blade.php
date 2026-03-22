@extends('pdf.layout')

@section('title', 'Laporan Transaksi Kasir')
@section('report_title', 'LAPORAN RIWAYAT TRANSAKSI KASIR')
@section('report_periode', $start && $end ? 'Periode: ' . \Carbon\Carbon::parse($start)->format('d/m/Y') . ' s.d ' .
    \Carbon\Carbon::parse($end)->format('d/m/Y') : 'Periode: Keseluruhan Sejak Awal')

@section('content')
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="20%" class="text-center">Tanggal & Waktu</th>
                <th width="25%" class="text-center">No. Invoice</th>
                <th width="25%">Nama Kasir</th>
                <th width="25%" class="text-right">Total Nominal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($transactions as $index => $trx)
                @php $grandTotal += $trx->total_harga; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($trx->created_at)->format('d/m/Y H:i') }}</td>
                    <td class="text-center">{{ $trx->invoice_no }}</td>
                    <td>{{ $trx->user->name }}</td>
                    <td class="text-right">Rp {{ number_format($trx->total_harga, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada riwayat transaksi.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-right font-bold">TOTAL NOMINAL TRANSAKSI</td>
                <td class="text-right font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
