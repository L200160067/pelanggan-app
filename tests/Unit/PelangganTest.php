<?php

use App\Models\Pelanggan;

beforeEach(function () {
    $this->pelanggan = Pelanggan::factory()->create();
});

describe('Pelanggan Model', function () {
    test('can create pelanggan', function () {
        expect($this->pelanggan)->toBeInstanceOf(Pelanggan::class);
        expect($this->pelanggan->id)->not->toBeNull();
    });

    test('pelanggan has required attributes', function () {
        expect($this->pelanggan)->toHaveProperty('nama');
        expect($this->pelanggan)->toHaveProperty('usia');
        expect($this->pelanggan)->toHaveProperty('alamat');
    });

    test('pelanggan attributes are fillable', function () {
        $data = [
            'nama' => 'Test Pelanggan',
            'usia' => 25,
            'alamat' => 'Test Alamat'
        ];

        $pelanggan = Pelanggan::create($data);

        expect($pelanggan->nama)->toBe('Test Pelanggan');
        expect($pelanggan->usia)->toBe(25);
        expect($pelanggan->alamat)->toBe('Test Alamat');
    });

    test('pelanggan has timestamps', function () {
        expect($this->pelanggan->created_at)->not->toBeNull();
        expect($this->pelanggan->updated_at)->not->toBeNull();
    });

    test('can update pelanggan', function () {
        $this->pelanggan->update([
            'nama' => 'Updated Name',
            'usia' => 30
        ]);

        expect($this->pelanggan->nama)->toBe('Updated Name');
        expect($this->pelanggan->usia)->toBe(30);
    });

    test('can delete pelanggan', function () {
        $id = $this->pelanggan->id;

        $this->pelanggan->delete();

        expect(Pelanggan::find($id))->toBeNull();
    });

    test('pelanggan scopeFilter returns results', function () {
        Pelanggan::factory()->create(['nama' => 'Bambang']);

        $result = Pelanggan::filter(['search' => 'Bambang'])->get();

        expect($result->count())->toBeGreaterThan(0);
    });

    test('pelanggan scopeFilter filters by alamat', function () {
        Pelanggan::factory()->create(['alamat' => 'Jalan Merdeka']);

        $result = Pelanggan::filter(['search' => 'Merdeka'])->get();

        expect($result->count())->toBeGreaterThan(0);
    });
});
