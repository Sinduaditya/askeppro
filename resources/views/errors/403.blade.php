<!-- filepath: resources/views/errors/403.blade.php -->
@extends('layouts.eror')

@section('code', '403')
@section('title', 'Akses Ditolak')
@section('color', '#ffc107')
@section('color-hover', '#e0a800')
@section('image', asset('images/403.svg'))

@section('message')
    Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda yakin seharusnya memiliki akses.
@endsection

@section('actions')
    <a href="javascript:history.back()" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-2"></i> Kembali
    </a>
@endsection
