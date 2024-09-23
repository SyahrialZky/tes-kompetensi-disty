@extends('components.app')

@section('title', 'Daftar Pemeriksaan')

@section('content')
    <div class="container">
        <h1>Pemeriksaan Pasien: {{ $patient->name }}</h1>

        <a href="{{ route('examinations.create', ['patient' => $patient->id]) }}" class="btn btn-primary mb-3">Tambah Pemeriksaan</a>

        @if ($examinations->isEmpty())
            <p>Tidak ada pemeriksaan yang ditemukan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Hasil</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($examinations as $examination)
                        <tr>
                            <td>{{ $examination->date }}</td>
                            <td>{{ $examination->category->name }}</td>
                            <td>{{ Str::limit($examination->results, 50) }}</td>
                            <td>
                                <a href="{{ route('examinations.show', $examination->id) }}" class="btn btn-info">Lihat</a>
                                <a href="{{ route('examinations.edit', $examination->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('examinations.destroy', $examination->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
