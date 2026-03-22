@extends('pdf.layout')

@section('title', 'Laporan Penjualan Barang ATK')
@section('report_title', 'LAPORAN PENJUALAN BARANG ATK')
@section('report_periode', $start && $end ? 'Periode: ' . \Carbon\Carbon::parse($start)->format('d/m/Y') . ' s.d ' .
    \Carbon\Carbon::parse($end)->format('d/m/Y') : 'Periode: Keseluruhan Sejak Awal')

@section('content')
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%" class="text-center">Tanggal</th>
                <th width="35%">Nama Barang (ATK)</th>
                <th width="10%" class="text-center">Qty (Pcs)</th>
                <th width="15%" class="text-right">Harga</th>
                <th width="20%" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $totalPcs = 0;
            @endphp
            @forelse($details as $index => $detail)
                @php
                    $grandTotal += $detail->subtotal;
                    $totalPcs += $detail->qty;
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($detail->transaction->created_at)->format('d/m/Y') }}
                    </td>
                    <td>{{ $detail->item->nama }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data penjualan barang ATK.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" class="text-right font-bold">TOTAL KESELURUHAN</td>
                <td class="text-center font-bold">{{ number_format($totalPcs, 0, ',', '.') }} Pcs</td>
                <td></td>
                <td class="text-right font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
