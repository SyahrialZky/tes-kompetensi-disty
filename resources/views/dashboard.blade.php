@section('title', 'Dashboard')
@extends('components.app')


@section('content')
    <div class="container">
        <h1>Welcome back {{ Auth::user()->name }}</h1>
        <!-- konten dashboard di sini -->
    </div>
@endsection
