<?php

use App\Models\Pelanggan;
use Tests\TestCase;

class PelangganShowTest extends TestCase
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
     * Test: Can display pelanggan detail page
     */
    public function test_can_display_pelanggan_detail(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.show');
        $response->assertViewHas('pelanggan', $this->pelanggan);
    }

    /**
     * Test: Detail page shows pelanggan data correctly
     */
    public function test_pelanggan_detail_shows_correct_data(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertSee($this->pelanggan->nama);
        $response->assertSee($this->pelanggan->usia);
        $response->assertSee($this->pelanggan->alamat);
    }

    /**
     * Test: Show page displays created_at date
     */
    public function test_show_page_displays_created_date(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertStatus(200);
        // Check bahwa created_at ditampilkan
        $response->assertViewHas('pelanggan', function ($pelanggan) {
            return $pelanggan->created_at !== null;
        });
    }

    /**
     * Test: Show page displays updated_at information
     */
    public function test_show_page_displays_updated_info(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertStatus(200);
        $response->assertViewHas('pelanggan', function ($pelanggan) {
            return $pelanggan->updated_at !== null;
        });
    }

    /**
     * Test: Cannot show non-existent pelanggan
     */
    public function test_cannot_show_non_existent_pelanggan(): void
    {
        $response = $this->get(route('pelanggan.show', 99999));

        $response->assertStatus(404);
    }

    /**
     * Test: Show page has edit link
     */
    public function test_show_page_has_edit_link(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertSee(route('pelanggan.edit', $this->pelanggan->id));
    }

    /**
     * Test: Show page has back link to index
     */
    public function test_show_page_has_back_link(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertSee(route('pelanggan.index'));
    }

    /**
     * Test: Show page displays pelanggan ID
     */
    public function test_show_page_displays_id(): void
    {
        $response = $this->get(route('pelanggan.show', $this->pelanggan->id));

        $response->assertSee($this->pelanggan->id);
    }
}
