@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Daftar Laporan</h2>
    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('reports.create')}}" class="btn btn-primary"> Tambah Laporan
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Pelapor</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        <tbody>
            @forelse ($reports as $report)
            <tr>
                <td>{{ $report -> title }}</td>
                <td>{{ $report->category?->name ?? '-' }}</td>
                <td>{{ $report -> user?->name ?? '-' }}</td>
                <td>{{ $report -> location ?? '-' }}</td>
                <td>{{$report -> status }}</td>
                <td>
                    <a href="{{ route('reports.show', $report->id) }}" class="btn btn-info btn-sm">Detail</a>
                <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning btn-sm ">Edit</a>
                <form action="{{ route('reports.destroy', $report->id) }}"
                    method="POST" class="d-inline" onsubmit="return confirm('Hapus Laporan Ini?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Hapus</button>
                </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">Belum ada laporan</td></tr>
            @endforelse
        </tbody>
        </table>

    </div>
    {{ $reports->links() }}
</div>
@endsection