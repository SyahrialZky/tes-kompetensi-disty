@extends('layouts.admin')

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Petugas</div>
                <div class="card-body">
                    <div class="text-center">
                        {{-- {{ $petugas }} --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">Pasien</div>
                <div class="card-body">
                    <div class="text-center">
                        {{-- {{ $pasien }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
