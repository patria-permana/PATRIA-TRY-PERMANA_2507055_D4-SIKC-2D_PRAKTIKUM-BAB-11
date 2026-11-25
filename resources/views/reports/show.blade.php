@extends('layouts.app')

@section('content')

<h1 style="font-weight: bold;">Detail Laporan</h1>
@if ($report->photo)
    <div class="row">
        <div class="container mb-3">
        <img src="{{ asset('storage/' . $report->photo) }}" 
            alt="Foto {{ $report->title }}"
            class="img-fluid rounded"
            style="max-height: 300px">
            <h3 style="font-weight: bold;">{{ $report->title }}</h3>
            <p style="display: flex; margin-bottom: 0px;">Kategori: {{ $report->category?->name }}</p>
            <p style="margin-bottom: 0;">Status: {{ $report->status }}</p>
            <p>Lokasi: {{ $report->location }}</p>
        </div>
    </div>


@else
    <div class="text-muted">Tidak ada foto</div>
@endif
<div class="container">
<a href="{{ route('reports.index') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection