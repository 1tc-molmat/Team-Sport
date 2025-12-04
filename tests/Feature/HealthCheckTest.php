<?php

namespace Tests\Feature;

use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * Test: Ping endpoint - health check sikeres
     */
    public function test_ping_endpoint_returns_success(): void
    {
        $response = $this->getJson('/api/ping');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'timestamp',
                'timezone',
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'API is running',
                'timezone' => config('app.timezone'),
            ]);
    }

    /**
     * Test: Ping endpoint - timestamp formátum ellenőrzés
     */
    public function test_ping_endpoint_returns_valid_timestamp(): void
    {
        $response = $this->getJson('/api/ping');

        $response->assertStatus(200);
        
        $data = $response->json();
        
        // Ellenőrizzük hogy létezik timestamp
        $this->assertArrayHasKey('timestamp', $data);
        
        // Ellenőrizzük hogy valid datetime string
        $timestamp = $data['timestamp'];
        $this->assertMatchesRegularExpression(
            '/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/',
            $timestamp
        );
    }

    /**
     * Test: Ping endpoint - timezone ellenőrzés
     */
    public function test_ping_endpoint_returns_correct_timezone(): void
    {
        $response = $this->getJson('/api/ping');

        $response->assertStatus(200)
            ->assertJson([
                'timezone' => 'Europe/Budapest',
            ]);
    }

    /**
     * Test: Ping endpoint - authentikáció nélkül is elérhető
     */
    public function test_ping_endpoint_accessible_without_authentication(): void
    {
        // Token nélkül is működnie kell (public endpoint)
        $response = $this->getJson('/api/ping');

        $response->assertStatus(200);
    }
}
