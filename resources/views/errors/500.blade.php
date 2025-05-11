<!-- filepath: resources/views/errors/500.blade.php -->
@extends('layouts.eror')

@section('code', '500')
@section('title', 'Server Error')
@section('color', '#dc3545')
@section('color-hover', '#bb2d3b')
@section('image', asset('images/500.svg'))

@section('message')
    Maaf, terjadi kesalahan pada server kami. Tim teknis kami telah diberitahu dan sedang menyelesaikan masalah ini.
@endsection

@section('actions')
    <a href="{{ url('/') }}" class="btn btn-primary me-2">
        <i class="fas fa-home me-2"></i> Kembali ke Beranda
    </a>
    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
@endsection
