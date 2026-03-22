@extends('pdf.layout')

@section('title', 'Laporan Rekap Keseluruhan')
@section('report_title', 'LAPORAN REKAPITULASI PENJUALAN (BARANG & JASA)')
@section('report_periode', $start && $end ? 'Periode: ' . \Carbon\Carbon::parse($start)->format('d/m/Y') . ' s.d ' .
    \Carbon\Carbon::parse($end)->format('d/m/Y') : 'Periode: Keseluruhan Sejak Awal')

@section('content')
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="10%">Tanggal</th>
                <th width="15%">No. Invoice</th>
                <th width="25%">Nama Item</th>
                <th width="10%" class="text-center">Tipe</th>
                <th width="10%" class="text-center">Qty</th>
                <th width="10%" class="text-right">Harga</th>
                <th width="15%" class="text-right">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp
            @forelse($details as $index => $detail)
                @php $grandTotal += $detail->subtotal; @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($detail->transaction->created_at)->format('d/m/Y') }}
                    </td>
                    <td class="text-center">{{ $detail->transaction->invoice_no }}</td>
                    <td>{{ $detail->item->nama }}</td>
                    <td class="text-center">{{ strtoupper($detail->item->type) }}</td>
                    <td class="text-center">{{ $detail->qty }}</td>
                    <td class="text-right">{{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data transaksi.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="7" class="text-right font-bold">TOTAL OMSET PENJUALAN</td>
                <td class="text-right font-bold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
@endsection
