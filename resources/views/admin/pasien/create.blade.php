@extends('layouts.admin')

@section('title', 'Form Tambah Pasien')

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
    <a href="{{ route('pasien.index') }}" class="text-primary">Data Pasien</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Tambah Pasien</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Tambah Pasien
                </div>
                <div class="card-body">
                    <form action="{{ route('pasien.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="nama_pasien">Nama Pasien</label>
                            <input type="text" name="nama_pasien" id="nama_pasien" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_pasien">NIK</label>
                            <input type="number" name="nik" id="nik" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="telp">No Telp</label>
                            <input type="number" name="telp" id="telp" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_pasien">Jenis Pasien</label>
                            <div class="input-group mb-3">
                                <select name="jenis_pasien" id="jenis_pasien" class="custom-select">
                                    <option value="bpjs" selected>Jenis Pasien (Default BPJS)</option>
                                    <option value="admin">Umum</option>
                                    <option value="bpjs">BPJS</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_periksa">Jenis Pemeriksaan</label>
                            <div class="input-group mb-3">
                                <select name="jenis_periksa" id="jenis_periksa" class="custom-select">
                                    <option selected>- Pilih -</option>
                                    <option value="kolestrol">Kolestrol</option>
                                    <option value="gula_darah">Gula Darah</option>
                                    <option value="tensi">Tensi</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" value="{{ old('tgl_periksa') }}" name="tgl_periksa" placeholder="Tanggal Pemeriksaan" class="form-control"
                                onfocusin="(this.type='date')" onfocusout="(this.type='text')">
                        </div>
                        <button type="submit" class="btn btn-success" style="width: 100%">SIMPAN</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            @if (Session::has('username'))
                <div class="alert alert-danger">
                    {{ Session::get('username') }}
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

