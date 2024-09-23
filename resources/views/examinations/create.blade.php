@extends('components.app')

@section('title', 'Tambah Pemeriksaan')

@section('content')
    <div class="container">
        <h1>Tambah Pemeriksaan untuk {{ $patient->name }}</h1>

        <form action="{{ route('examinations.store', ['patient' => $patient->id]) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="date">Tanggal Pemeriksaan</label>
                <input type="date" name="date" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="results">Hasil Pemeriksaan</label>
                <textarea name="results" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
