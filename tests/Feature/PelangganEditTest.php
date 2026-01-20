<?php

use App\Models\Pelanggan;
use Tests\TestCase;

class PelangganEditTest extends TestCase
{
    /**
     * Setup untuk setiap test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->pelanggan = Pelanggan::factory()->create();
    }

    /**
     * Test: Can display edit form
     */
    public function test_can_display_edit_form(): void
    {
        $response = $this->get(route('pelanggan.edit', $this->pelanggan->id));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.edit');
        $response->assertViewHas('pelanggan', $this->pelanggan);
    }

    /**
     * Test: Edit form shows current pelanggan data
     */
    public function test_edit_form_shows_current_data(): void
    {
        $response = $this->get(route('pelanggan.edit', $this->pelanggan->id));

        $response->assertSee($this->pelanggan->nama);
        $response->assertSee($this->pelanggan->usia);
        $response->assertSee($this->pelanggan->alamat);
    }

    /**
     * Test: Can update pelanggan with valid data
     */
    public function test_can_update_pelanggan_with_valid_data(): void
    {
        $newData = [
            'nama' => 'Updated Name',
            'usia' => 35,
            'alamat' => 'Jl. Baru No. 456, Bandung'
        ];

        $response = $this->put(route('pelanggan.update', $this->pelanggan->id), $newData);

        $response->assertRedirect(route('pelanggan.index'));
        $response->assertSessionHas('success', 'Pelanggan berhasil diperbarui.');

        $this->assertDatabaseHas('pelanggans', [
            'id' => $this->pelanggan->id,
            'nama' => $newData['nama'],
            'usia' => $newData['usia'],
            'alamat' => $newData['alamat']
        ]);
    }

    /**
     * Test: Cannot update with empty nama
     */
    public function test_cannot_update_with_empty_nama(): void
    {
        $data = [
            'nama' => '',
            'usia' => 35,
            'alamat' => 'Jl. Baru No. 456'
        ];

        $response = $this->put(route('pelanggan.update', $this->pelanggan->id), $data);

        $response->assertSessionHasErrors('nama');
    }

    /**
     * Test: Cannot update with short nama
     */
    public function test_cannot_update_with_short_nama(): void
    {
        $data = [
            'nama' => 'AB',
            'usia' => 35,
            'alamat' => 'Jl. Baru No. 456'
        ];

        $response = $this->put(route('pelanggan.update', $this->pelanggan->id), $data);

        $response->assertSessionHasErrors('nama');
    }

    /**
     * Test: Cannot update with invalid usia
     */
    public function test_cannot_update_with_invalid_usia(): void
    {
        $data = [
            'nama' => 'Valid Name',
            'usia' => 200,
            'alamat' => 'Jl. Baru No. 456'
        ];

        $response = $this->put(route('pelanggan.update', $this->pelanggan->id), $data);

        $response->assertSessionHasErrors('usia');
    }

    /**
     * Test: Cannot update with empty alamat
     */
    public function test_cannot_update_with_empty_alamat(): void
    {
        $data = [
            'nama' => 'Valid Name',
            'usia' => 35,
            'alamat' => ''
        ];

        $response = $this->put(route('pelanggan.update', $this->pelanggan->id), $data);

        $response->assertSessionHasErrors('alamat');
    }

    /**
     * Test: Cannot update with short alamat
     */
    public function test_cannot_update_with_short_alamat(): void
    {
        $data = [
            'nama' => 'Valid Name',
            'usia' => 35,
            'alamat' => 'Jln'
        ];

        $response = $this->put(route('pelanggan.update', $this->pelanggan->id), $data);

        $response->assertSessionHasErrors('alamat');
    }

    /**
     * Test: Partial update only updates changed fields
     */
    public function test_partial_update_preserves_unchanged_fields(): void
    {
        $originalNama = $this->pelanggan->nama;

        $data = [
            'nama' => $originalNama,
            'usia' => 40,
            'alamat' => $this->pelanggan->alamat
        ];

        $this->put(route('pelanggan.update', $this->pelanggan->id), $data);

        $this->assertDatabaseHas('pelanggans', [
            'id' => $this->pelanggan->id,
            'nama' => $originalNama,
            'usia' => 40
        ]);
    }

    /**
     * Test: Cannot update non-existent pelanggan
     */
    public function test_cannot_update_non_existent_pelanggan(): void
    {
        $data = [
            'nama' => 'Updated Name',
            'usia' => 35,
            'alamat' => 'Jl. Baru No. 456'
        ];

        $response = $this->put(route('pelanggan.update', 99999), $data);

        $response->assertStatus(404);
    }
}
