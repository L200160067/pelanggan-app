@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold">Detail Pelanggan</h5>
                    <span class="badge bg-primary">ID: {{ $pelanggan->id }}</span>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%" class="text-secondary">Nama Lengkap</th>
                            <td width="5%">:</td>
                            <td class="fw-bold">{{ $pelanggan->nama }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Usia</th>
                            <td>:</td>
                            <td>{{ $pelanggan->usia }} Tahun</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Alamat</th>
                            <td>:</td>
                            <td>{{ $pelanggan->alamat }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Terdaftar Pada</th>
                            <td>:</td>
                            {{-- Format tanggal agar lebih manusiawi --}}
                            <td>{{ $pelanggan->created_at->format('d F Y, H:i') }}</td>
                        </tr>
                        <tr>
                            <th class="text-secondary">Terakhir Diupdate</th>
                            <td>:</td>
                            <td>{{ $pelanggan->updated_at->diffForHumans() }}</td>
                        </tr>
                    </table>

                    <hr>

                    <div class="d-flex gap-2">
                        <a href="{{ route('pelanggan.index') }}" class="btn btn-secondary">Kembali</a>
                        <a href="{{ route('pelanggan.edit', $pelanggan->id) }}" class="btn btn-warning text-white">Edit Data
                            Ini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection