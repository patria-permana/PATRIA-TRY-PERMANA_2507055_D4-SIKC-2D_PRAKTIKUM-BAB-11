@extends('layouts.app')

@section('content')

<h2>Edit Laporan</h2>

<form action="{{ route('reports.update', $report->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text"
            name="title"
            value="{{ old('title', $report->title) }}"
            class="form-control @error('title') is-invalid @enderror">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description"
            class="form-control @error('description') is-invalid @enderror"
            rows="3">{{ old('description', $report->description) }}</textarea>
        @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text"
            name="location"
            value="{{ old('location', $report->location) }}"
            class="form-control @error('location') is-invalid @enderror">
        @error('location')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Kategori</label>
        <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ old('category_id', $report->category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Bukti Foto</label>

        @if ($report->photo)
        <div class="mb-2">
            <img src="{{ asset('storage/' . $report->photo) }}"
                alt="Foto {{ $report->title }}"
                class="img-fluid rounded"
                style="max-height: 200px">
        </div>
        @endif

        <input type="file"
            name="photo"
            class="form-control @error('photo') is-invalid @enderror"
            accept="image/jpeg, image/png">
        <div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>
        @error('photo')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button class="btn btn-primary">Perbarui</button>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection
