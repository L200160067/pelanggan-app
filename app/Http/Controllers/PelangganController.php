<?php

namespace App\Http\Controllers;


use App\Models\Pelanggan;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Http\Resources\PelangganResource;
use App\Http\Resources\PelangganCollection;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all pelanggan
        // Baca: "Ambil Pelanggan terbaru, filter berdasarkan request, lalu paginate."
        $pelanggan = Pelanggan::latest()
            ->filter(request(['search'])) // Memanggil scopeFilter tadi
            ->paginate(10); // 10 data per halaman

        // Pertahankan query string di URL
        $pelanggan->appends(request()->all());

        //render view with pelanggan
        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Render halaman form tambah
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePelangganRequest $request)
    {
        // Simpan data pelanggan baru
        // Validasi sudah dilakukan oleh StorePelangganRequest
        Pelanggan::create($request->validated());

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        // Render halaman detail dengan membawa data pelanggan
        return view('pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        // Render halaman form edit dengan membawa data pelanggan
        return view('pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePelangganRequest $request, Pelanggan $pelanggan)
    {
        // Update data pelanggan
        // Validasi sudah dilakukan oleh UpdatePelangganRequest
        $pelanggan->update($request->validated());

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        // Hapus data pelanggan
        $pelanggan->delete();

        // Redirect ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('pelanggan.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
