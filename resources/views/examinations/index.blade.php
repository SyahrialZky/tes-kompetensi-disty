@extends('components.app')

@section('title', 'Daftar Pemeriksaan')

@section('content')
    <div class="container">
        <h1>Pemeriksaan Pasien: {{ $patient->name }}</h1>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('examinations.create', ['patient' => $patient->id]) }}" class="btn btn-primary mb-3 ">Tambah Pemeriksaan</a>
        @if(is_null($patient->diagnosa))
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#diagnosaModal">Input Diagnosa</button>
         @endif
        </div>
        @if ($examinations->isEmpty())
            <p>Tidak ada pemeriksaan yang ditemukan.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Hasil</th>
                        <th>Tarif</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($examinations as $examination)
                        <tr>
                            <td>{{ $examination->date }}</td>
                            <td>{{ $examination->category->name }}</td>
                            <td>{{ Str::limit($examination->results, 50) }}</td>
                            <td>{{ $examination->tarif }}</td>
                            <td>
                                @if ($examination->status)
                                    <span style="background-color: #d4edda; color: #155724; padding: 5px; border-radius: 5px;">
                                        Sudah ditangani
                                    </span>
                                @else
                                    <span style="background-color: #f8d7da; color: #721c24; padding: 5px; border-radius: 5px;">
                                        Belum ditangani
                                    </span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('examinations.handle', $examination->id) }}" class="btn btn-success">Handle</a>
                                <a href="{{ route('examinations.edit', $examination->id) }}" class="btn btn-warning">Edit</i></a>
                                <form action="{{ route('examinations.destroy', $examination->id) }}" method="POST" class="d-inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <a href="{{ route('patients.index') }}" class="btn btn-danger">Kembali</a>

        @endif
    </div>

    <!-- Card Diagnosa -->
    <div class="card mt-4">
        <div class="card-header">
            <h4>Diagnosa</h4>
        </div>
        <div class="card-body">
            @if (is_null($patient->diagnosa))
                <p class="text-danger">Pasien belum didiagnosa.</p>
            @else
                <p><strong>Diagnosa:</strong> {{ $patient->diagnosa }}</p>
                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#diagnosaModal">Edit Diagnosa</button>
            @endif
        </div>
    </div>

    <!-- Modal Diagnosa -->
<div class="modal fade" id="diagnosaModal" tabindex="-1" aria-labelledby="diagnosaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('patients.updateDiagnosa', $patient->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="diagnosaModalLabel">Input Diagnosa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="diagnosa">Diagnosa</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" required>{{ $patient->diagnosa ?? '' }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Diagnosa</button>
                </div>
            </div>
        </form>
    </div>
</div>
    
@endsection
