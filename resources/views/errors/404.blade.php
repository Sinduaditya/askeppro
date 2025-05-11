<!-- filepath: resources/views/errors/404.blade.php -->
@extends('layouts.eror')

@section('code', '404')
@section('title', 'Halaman Tidak Ditemukan')
@section('color', '#0d6efd')
@section('color-hover', '#0b5ed7')
@section('image', asset('images/404.svg'))

@section('message')
    Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah dipindahkan atau dihapus.
@endsection

@section('actions')
    <a href="{{ url('/') }}" class="btn btn-primary me-2">
        <i class="fas fa-home me-2"></i> Kembali ke Beranda
    </a>
    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
@endsection
