<?php

use App\Models\Pelanggan;
use Tests\TestCase;

class PelangganDeleteTest extends TestCase
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
     * Test: Can delete pelanggan
     */
    public function test_can_delete_pelanggan(): void
    {
        $response = $this->delete(route('pelanggan.destroy', $this->pelanggan->id));

        $response->assertRedirect(route('pelanggan.index'));
        $response->assertSessionHas('success', 'Pelanggan berhasil dihapus.');

        $this->assertDatabaseMissing('pelanggans', [
            'id' => $this->pelanggan->id
        ]);
    }

    /**
     * Test: Cannot delete non-existent pelanggan
     */
    public function test_cannot_delete_non_existent_pelanggan(): void
    {
        $response = $this->delete(route('pelanggan.destroy', 99999));

        $response->assertStatus(404);
    }

    /**
     * Test: After delete, pelanggan is completely removed from database
     */
    public function test_deleted_pelanggan_is_removed_from_database(): void
    {
        $pelangganId = $this->pelanggan->id;

        $this->delete(route('pelanggan.destroy', $pelangganId));

        $this->assertNull(Pelanggan::find($pelangganId));
    }

    /**
     * Test: Deleting one pelanggan doesn't affect others
     */
    public function test_delete_only_affects_target_pelanggan(): void
    {
        $otherPelanggan = Pelanggan::factory()->create();

        $this->delete(route('pelanggan.destroy', $this->pelanggan->id));

        $this->assertDatabaseHas('pelanggans', [
            'id' => $otherPelanggan->id,
            'nama' => $otherPelanggan->nama
        ]);
    }

    /**
     * Test: Delete with method delete
     */
    public function test_delete_uses_delete_method(): void
    {
        $response = $this->delete(route('pelanggan.destroy', $this->pelanggan->id));

        $response->assertStatus(302); // Redirect
        $this->assertDatabaseMissing('pelanggans', [
            'id' => $this->pelanggan->id
        ]);
    }

    /**
     * Test: Cannot delete using GET method
     */
    public function test_cannot_delete_using_get_method(): void
    {
        $response = $this->get(route('pelanggan.destroy', $this->pelanggan->id));

        $response->assertStatus(404); // Route not found

        $this->assertDatabaseHas('pelanggans', [
            'id' => $this->pelanggan->id
        ]);
    }
}
