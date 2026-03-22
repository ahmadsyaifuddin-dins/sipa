@extends('pdf.layout')

@section('title', 'Laporan Pendapatan Keuangan')
@section('report_title', 'LAPORAN REKAPITULASI PENDAPATAN')
@section('report_periode', $start && $end ? 'Periode: ' . \Carbon\Carbon::parse($start)->format('d/m/Y') . ' s.d ' .
    \Carbon\Carbon::parse($end)->format('d/m/Y') : 'Periode: Keseluruhan Sejak Awal')

@section('content')
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="35%" class="text-center">Tanggal Transaksi</th>
                <th width="30%" class="text-center">Jumlah Transaksi Masuk</th>
                <th width="30%" class="text-right">Total Pendapatan Bersih</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $totalTransaksi = 0;
            @endphp
            @forelse($pendapatans as $index => $data)
                @php
                    $grandTotal += $data->total_pendapatan;
                    $totalTransaksi += $data->total_transaksi;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, d F Y') }}</td>
                    <td class="text-center">{{ $data->total_transaksi }} Transaksi</td>
                    <td class="text-right">Rp {{ number_format($data->total_pendapatan, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Belum ada data pendapatan.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="text-right font-bold">TOTAL KESELURUHAN</td>
                <td class="text-center font-bold">{{ $totalTransaksi }} Transaksi</td>
                <td class="text-right font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
