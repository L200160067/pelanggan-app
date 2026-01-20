<?php

use App\Models\Pelanggan;
use Tests\TestCase;

class PelangganCreateTest extends TestCase
{
    /**
     * Test: Can display create form
     */
    public function test_can_display_create_form(): void
    {
        $response = $this->get(route('pelanggan.create'));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.create');
    }

    /**
     * Test: Can store new pelanggan with valid data
     */
    public function test_can_create_pelanggan_with_valid_data(): void
    {
        $data = [
            'nama' => 'John Doe',
            'usia' => 30,
            'alamat' => 'Jl. Sudirman No. 123, Jakarta'
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertRedirect(route('pelanggan.index'));
        $response->assertSessionHas('success', 'Pelanggan berhasil ditambahkan.');

        $this->assertDatabaseHas('pelanggans', $data);
    }

    /**
     * Test: Cannot create pelanggan with empty nama
     */
    public function test_cannot_create_pelanggan_with_empty_nama(): void
    {
        $data = [
            'nama' => '',
            'usia' => 30,
            'alamat' => 'Jl. Sudirman No. 123'
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('nama');
        $this->assertCount(0, Pelanggan::where('nama', '')->get());
    }

    /**
     * Test: Cannot create pelanggan with nama less than 3 characters
     */
    public function test_cannot_create_pelanggan_with_short_nama(): void
    {
        $data = [
            'nama' => 'AB', // Less than 3 chars
            'usia' => 30,
            'alamat' => 'Jl. Sudirman No. 123'
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('nama');
    }

    /**
     * Test: Cannot create pelanggan with invalid usia (negative)
     */
    public function test_cannot_create_pelanggan_with_negative_usia(): void
    {
        $data = [
            'nama' => 'John Doe',
            'usia' => -5,
            'alamat' => 'Jl. Sudirman No. 123'
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('usia');
    }

    /**
     * Test: Cannot create pelanggan with usia more than 150
     */
    public function test_cannot_create_pelanggan_with_usia_over_150(): void
    {
        $data = [
            'nama' => 'John Doe',
            'usia' => 200,
            'alamat' => 'Jl. Sudirman No. 123'
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('usia');
    }

    /**
     * Test: Cannot create pelanggan with empty alamat
     */
    public function test_cannot_create_pelanggan_with_empty_alamat(): void
    {
        $data = [
            'nama' => 'John Doe',
            'usia' => 30,
            'alamat' => ''
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('alamat');
    }

    /**
     * Test: Cannot create pelanggan with alamat less than 5 characters
     */
    public function test_cannot_create_pelanggan_with_short_alamat(): void
    {
        $data = [
            'nama' => 'John Doe',
            'usia' => 30,
            'alamat' => 'Jln' // Less than 5 chars
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('alamat');
    }

    /**
     * Test: Nama field has max length 255
     */
    public function test_cannot_create_pelanggan_with_nama_over_255(): void
    {
        $data = [
            'nama' => str_repeat('a', 256),
            'usia' => 30,
            'alamat' => 'Jl. Sudirman No. 123'
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('nama');
    }

    /**
     * Test: Alamat field has max length 1000
     */
    public function test_cannot_create_pelanggan_with_alamat_over_1000(): void
    {
        $data = [
            'nama' => 'John Doe',
            'usia' => 30,
            'alamat' => str_repeat('a', 1001)
        ];

        $response = $this->post(route('pelanggan.store'), $data);

        $response->assertSessionHasErrors('alamat');
    }

    /**
     * Test: Dapat store pelanggan with factory data
     */
    public function test_can_create_pelanggan_with_factory(): void
    {
        $pelanggan = Pelanggan::factory()->make();

        $response = $this->post(route('pelanggan.store'), [
            'nama' => $pelanggan->nama,
            'usia' => $pelanggan->usia,
            'alamat' => $pelanggan->alamat
        ]);

        $response->assertRedirect(route('pelanggan.index'));
        $this->assertDatabaseHas('pelanggans', [
            'nama' => $pelanggan->nama
        ]);
    }
}
