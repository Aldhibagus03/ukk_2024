@extends('layouts.master')

@section('title', 'Data Kategori')

@section('header', 'Tutorial Laravel 11 untuk Sepuh')

@section('content')
@forelse ($categorys as $rowCategory)
    {{ $rowCategory->id }}
    {{ $rowCategory->deskripsi }}
    {{ $rowCategory->kategori }}
    <br>
@empty
    {{ "Kosong" }}
@endforelse
@endsection