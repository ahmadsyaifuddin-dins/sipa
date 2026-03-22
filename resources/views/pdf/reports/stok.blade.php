@extends('pdf.layout')

@section('title', 'Laporan Stok Barang ATK')
@section('report_title', 'LAPORAN KETERSEDIAAN STOK BARANG')
@section('report_periode', 'Kondisi per: ' . \Carbon\Carbon::now('Asia/Makassar')->translatedFormat('d F Y, H:i') . '
    WITA')

@section('content')
    <table class="table-data">
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="15%">Kode</th>
                <th width="40%">Nama Barang</th>
                <th width="25%">Kategori</th>
                <th width="15%" class="text-center">Sisa Stok</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td class="text-center">{{ $item->kode }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->category->nama_kategori ?? '-' }}</td>
                    <td class="text-center">{{ $item->stok }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada data barang.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
