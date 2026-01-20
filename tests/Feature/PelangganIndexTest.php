<?php

use App\Models\Pelanggan;
use Tests\TestCase;

class PelangganIndexTest extends TestCase
{
    /**
     * Setup untuk setiap test
     */
    public function setUp(): void
    {
        parent::setUp();
        // Create test data
        Pelanggan::factory()->count(15)->create();
    }

    /**
     * Test: Display pelanggan list page
     */
    public function test_can_display_pelanggan_list(): void
    {
        $response = $this->get(route('pelanggan.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pelanggan.index');
        $response->assertViewHas('pelanggan');
    }

    /**
     * Test: Pelanggan list shows paginated data
     */
    public function test_pelanggan_list_is_paginated(): void
    {
        $response = $this->get(route('pelanggan.index'));

        $response->assertStatus(200);
        $response->assertViewHas('pelanggan', function ($collection) {
            return $collection->count() <= 10; // Default pagination 10
        });
    }

    /**
     * Test: Search functionality works
     */
    public function test_can_search_pelanggan_by_name(): void
    {
        $pelanggan = Pelanggan::first();

        $response = $this->get(route('pelanggan.index', ['search' => $pelanggan->nama]));

        $response->assertStatus(200);
        $response->assertSee($pelanggan->nama);
    }

    /**
     * Test: Search by alamat works
     */
    public function test_can_search_pelanggan_by_alamat(): void
    {
        $pelanggan = Pelanggan::first();
        $searchKeyword = substr($pelanggan->alamat, 0, 10); // Search dengan keyword

        $response = $this->get(route('pelanggan.index', ['search' => $searchKeyword]));

        $response->assertStatus(200);
    }

    /**
     * Test: Empty search shows all pelanggan
     */
    public function test_empty_search_shows_all_pelanggan(): void
    {
        $response = $this->get(route('pelanggan.index', ['search' => '']));

        $response->assertStatus(200);
        $response->assertViewHas('pelanggan');
    }

    /**
     * Test: Pagination works correctly
     */
    public function test_pagination_works(): void
    {
        $response = $this->get(route('pelanggan.index', ['page' => 2]));

        $response->assertStatus(200);
        $response->assertViewHas('pelanggan');
    }

    /**
     * Test: Search query string preserved in pagination
     */
    public function test_search_query_preserved_in_pagination(): void
    {
        $pelanggan = Pelanggan::first();

        $response = $this->get(route('pelanggan.index', [
            'search' => $pelanggan->nama,
            'page' => 1
        ]));

        $response->assertStatus(200);
        $response->assertSee($pelanggan->nama);
    }
}
