@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-primary">Data Pelanggan</h5>
            {{-- Link ke Halaman Create --}}
            <a href="{{ route('pelanggan.create') }}" class="btn btn-primary btn-sm">
                + Tambah Pelanggan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" width="5%">No</th>
                            <th scope="col">Nama</th>
                            <th scope="col" width="10%">Usia</th>
                            <th scope="col">Alamat</th>
                            <th scope="col" width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pelanggan as $p)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->usia }}</td>
                                <td>{{ $p->alamat }}</td>
                                <td class="text-center">
                                    {{-- Tombol Detail --}}
                                    <a href="{{ route('pelanggan.show', $p->id) }}" class="btn btn-info btn-sm text-white me-1">
                                        Detail
                                    </a>
                                    {{-- Link ke Halaman Edit --}}
                                    <a href="{{ route('pelanggan.edit', $p->id) }}" class="btn btn-warning btn-sm text-white">
                                        Edit
                                    </a>

                                    <form action="{{ route('pelanggan.destroy', $p->id) }}" method="POST" class="d-inline"
                                        onsubmit="return confirm('Yakin hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Belum ada data pelanggan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination jika ada --}}
            <div class="mt-3">
                {{ $pelanggan->links() }}
            </div>
        </div>
    </div>
@endsection