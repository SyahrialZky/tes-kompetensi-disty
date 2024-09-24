@extends('components.app')

@section('title', 'Edit Pemeriksaan')

@section('content')
    <div class="container">
        <h1>Edit Pemeriksaan untuk {{ $examination->patient->name }}</h1>

        <form action="{{ route('examinations.update', $examination->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="date">Tanggal Pemeriksaan</label>
                <input type="date" name="date" class="form-control" value="{{ $examination->date }}" required>
            </div>

            <div class="form-group">
                <label for="category_id">Kategori</label>
                <select name="category_id" class="form-control" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $examination->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="results">Hasil Pemeriksaan</label>
                <textarea name="results" class="form-control" required>{{ $examination->results }}</textarea>
            </div>
            <div class="form-group">
                <label for="tarif">Tarif</label>
                <input type="number" id="tarif" name="tarif" class="form-control" value="{{ $examination->tarif }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
@endsection
