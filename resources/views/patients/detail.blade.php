@extends('components.app')

@section('title', 'Detail Pasien')

@section('content')
<div class="container">
    @php
        // Inisialisasi variabel sebelum rendering dimulai
        $totalTagihanSetelahDiskon = 0; 

        // Proses perhitungan total tagihan di sini sebelum menampilkan HTML
        foreach($patient->examinations as $examination) {
            $tarifAsli = $examination->tarif;
            $tarifSetelahDiskon = $tarifAsli;

            // Aturan diskon BPJS dan Umum
            if ($examination->category->name == 'BPJS' && $tarifAsli >= 500000) {
                $tarifSetelahDiskon *= 0.4; // Diskon 60%
            } elseif ($examination->category->name == 'Umum' && $tarifAsli < 500000) {
                $tarifSetelahDiskon *= 0.9; // Diskon 10%
            }

            // Menambahkan tarif setelah diskon ke total tagihan
            $totalTagihanSetelahDiskon += $tarifSetelahDiskon;
        }
    @endphp

    <div class="card mb-3 mt-3">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2>Detail Pasien</h2>
            <a href="{{ route('patients.index') }}" class="btn btn-danger">Kembali ke Daftar Pasien</a>
        </div>
        <div class="card-body">
            <!-- Informasi Pasien -->
            <h3>Informasi Pasien</h3>
            <table class="table table-borderless">
                <tr>
                    <th>Nama:</th>
                    <td>{{ $patient->name }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir:</th>
                    <td>{{ \Carbon\Carbon::parse($patient->date_of_birth)->format('d F Y') }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin:</th>
                    <td>{{ ucfirst($patient->gender == 'male') ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>No Telepon:</th>
                    <td>{{ $patient->no_telp }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $patient->email }}</td>
                </tr>
                <tr>
                    <th>Total Tagihan:</th>
                    <!-- Menampilkan total tagihan yang dihitung -->
                    <td>Rp {{ number_format($totalTagihanSetelahDiskon, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Keluhan:</th>
                    <td>{{ $patient->keluhan }}</td>
                </tr>
                <tr>
                    <th>Diagnosa:</th>
                    <!-- Tampilkan diagnosa atau pesan "Belum di Diagnosa" jika diagnosa null -->
                    <td>
                        @if(is_null($patient->diagnosa))
                            <span class="text-danger">Belum di Diagnosa</span>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#diagnosaModal">Input Diagnosa</button>
                        @else
                            {{ $patient->diagnosa }}
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Detail Pemeriksaan -->
    <div class="card">
        <div class="card-header">
            <h3>Detail Pemeriksaan</h3>
        </div>
        <div class="card-body">
            @if($patient->examinations->isEmpty())
                <p>Pasien belum memiliki pemeriksaan.</p>
            @else
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hasil Pemeriksaan</th>
                            <th>Kategori</th>
                            <th>Tarif (Sebelum Diskon)</th>
                            <th>Tarif (Setelah Diskon)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patient->examinations as $examination)
                            @php
                                $tarifAsli = $examination->tarif;
                                $tarifSetelahDiskon = $tarifAsli;

                                // Aturan diskon BPJS dan Umum
                                if ($examination->category->name == 'BPJS' && $tarifAsli >= 500000) {
                                    $tarifSetelahDiskon *= 0.4; // Diskon 60%
                                } elseif ($examination->category->name == 'Umum' && $tarifAsli < 500000) {
                                    $tarifSetelahDiskon *= 0.9; // Diskon 10%
                                }
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $examination->results }}</td>
                                <td>{{ $examination->category->name }}</td>
                                <td>Rp {{ number_format($tarifAsli, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($tarifSetelahDiskon, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
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
                        <textarea name="diagnosa" id="diagnosa" class="form-control" required></textarea>
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
