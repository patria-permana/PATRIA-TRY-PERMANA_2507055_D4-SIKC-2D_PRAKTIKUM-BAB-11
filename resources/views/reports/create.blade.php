@extends('layouts.app')


@section('content')

<form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data"> 
    @csrf 
    <div class="mb-3">
    <label for="" class="form-label">Nama</label>
    <input type="text"
            name="title"
            class="form-control 
            @error('title') is-invalid
            @enderror"
            >
            @error('title') 
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Description</label>
        <input type="text"
                name="description"
                class="form-control @error('description') is-invalid
                @enderror">
                @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label">Location</label>
        <input type="text"
                name="location"
                class="form-control @error('location') is-invalid
                @enderror">
                @error('location')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
    </div>

    <div class="mb-3">
        <label for="" class="form-label"> Kategori</label>
        <select name="category_id" id="category_id">
            <option value="">Pilih Kategori</option>
            @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        
            @endforeach
        </select>
    </div>

    <div class="mb-3"> 
        <label for="" class="form-label">Bukti Foto</label>
        <input type="file" 
                name="photo"
                class="form-control @error('photo') is-invalid
                @enderror" accept="image/jpeg, image/png">
                
                @error('photo')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
    </div>
    <button class="btn btn-primary">Simpan</button>
</form>

@endsection

