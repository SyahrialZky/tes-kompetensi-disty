@extends('components.app')

@section('title', 'Daftar Pasien')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Daftar Pasien</h1>
        <a href="{{ route('patients.create') }}" class="btn btn-primary">Tambah Pasien</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $patient->name }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ ucfirst($patient->gender) }}</td>
                    <td>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-info btn-sm"><i class="fas fa-search"></i></a>
                        <a href="{{ route('patients.show', $patient->id) }}" class="btn btn-success btn-sm"><i class="fas fa-stethoscope"></i></a>
                        <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                        <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pasien ini?')"><i class="fas fa-eraser"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
