@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data pasien')

@section('content')
    <a href="{{ route('pasien.create') }}" class="btn btn-purple mb-2">Tambah Pasien</a>
    <table id="pasienTable" class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>NIK</th>
                <th>Telp</th>
                <th>Jenis Pasien</th>
                <th>Jenis Pemeriksaan</th>
                <th>Tanggal Pemeriksaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pasien as $k => $v)
            <tr>
                <td>{{ $k += 1 }}</td>
                <td>{{ $v->nama_pasien }}</td>
                <td>{{ $v->nik }}</td>
                <td>{{ $v->telp }}</td>
                <td>{{ $v->jenis_pasien }}</td>
                <td>{{ $v->jenis_periksa }}</td>
                <td>{{ $v->tgl_periksa }}</td>
                <td><a href="{{ route('pasien.edit', $v->id_pasien) }}" style="text-decoration: underline">Lihat</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#pasienTable').DataTable();
        } );
    </script>
@endsection
