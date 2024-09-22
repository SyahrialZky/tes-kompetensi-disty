@extends('layouts.admin')

@section('title', 'Form Edit Pasien')

@section('css')
    <style>
        .text-primary:hover {
            text-decoration: underline;
        }

        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
        }
    </style>
@endsection

@section('header')
    <a href="{{ route('pasien.index') }}" class="text-primary">Data pasien</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Edit pasien</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Edit Pasien
                </div>
                <div class="card-body">
                    <form action="{{ route('pasien.update', $pasien->id_pasien) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" value="{{ $pasien->nama_pasien }}" name="nama_pasien" id="nama_pasien" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="number" value="{{ $pasien->nik }}" name="nik" id="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No Telp</label>
                            <input type="number" value="{{ $pasien->telp }}" name="telp" id="telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="level">Jenis Pasien</label>
                            <div class="input-group mb-3">
                                <select name="level" id="level" class="custom-select">
                                    @if ($pasien->level == 'umum')
                                    <option selected value="umum">Umum</option>
                                    <option value="bpjs">bpjs</option>
                                    @else
                                    <option value="umum">Umum</option>
                                    <option selected value="bpjs">BPJS</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="level">Jenis Pemeriksaan</label>
                            <div class="input-group mb-3">
                                <select name="level" id="level" class="custom-select">
                                    <option value="kolestrol" selected>Kolstrol</option>
                                    <option value="gula_darah">Gula Darah</option>
                                    <option value="tensi">Tensi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('tgl_periksa') }}" name="tgl_periksa" placeholder="Tanggal Pemeriksaan" class="form-control"
                                onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <div class="form-group">
                            <label for="level">Level</label>
                            <div class="input-group mb-3">
                                <select name="level" id="level" class="custom-select">
                                    @if ($pasien->level == 'admin')
                                    <option selected value="admin">Admin</option>
                                    <option value="pasien">pasien</option>
                                    @else
                                    <option value="admin">Admin</option>
                                    <option selected value="pasien">Pasien</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning text-white" style="width: 100%">UPDATE</button>
                    </form>
                    @if ($pasien->id_pasien != 1)
                    <form action="{{ route('pasien.destroy', $pasien->id_pasien) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger mt-2" style="width: 100%" onclick="return confirm('YAKIN INGIN MENGHAPUS?')">HAPUS</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            @if (Session::has('notif'))
                <div class="alert alert-danger">
                    {{ Session::get('notif') }}
                </div>
            @endif
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection

