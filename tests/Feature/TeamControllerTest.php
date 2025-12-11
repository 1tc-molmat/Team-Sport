<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Team;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Helper: Authentikált user létrehozása és token generálása
     */
    private function authenticatedUser()
    {
        $user = User::factory()->create();
        $token = $user->createToken('test_token')->plainTextToken;
        return ['user' => $user, 'token' => $token];
    }

    /**
     * Test: Teams index - lista lekérése authentikálva
     */
    public function test_authenticated_user_can_get_teams_list(): void
    {
        $auth = $this->authenticatedUser();
        Team::factory()->count(3)->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->getJson('/api/teams');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'name', 'sport_type', 'max_members', 'members_count', 'members'],
                ],
            ]);
    }

    /**
     * Test: Teams index - token nélkül
     */
    public function test_teams_list_fails_without_authentication(): void
    {
        $response = $this->getJson('/api/teams');

        $response->assertStatus(401);
    }

    /**
     * Test: Team create - sikeres létrehozás
     */
    public function test_authenticated_user_can_create_team(): void
    {
        $auth = $this->authenticatedUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->postJson('/api/teams', [
            'name' => 'Test Warriors',
            'sport_type' => 'football',
            'max_members' => 15,
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'data' => ['id', 'name', 'sport_type', 'max_members'],
            ])
            ->assertJson([
                'message' => 'Team created successfully',
                'data' => [
                    'name' => 'Test Warriors',
                    'sport_type' => 'football',
                    'max_members' => 15,
                ],
            ]);

        $this->assertDatabaseHas('teams', [
            'name' => 'Test Warriors',
            'sport_type' => 'football',
        ]);
    }

    /**
     * Test: Team create - validációs hiba
     */
    public function test_create_team_fails_with_missing_fields(): void
    {
        $auth = $this->authenticatedUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->postJson('/api/teams', [
            // Hiányzik name, sport_type
        ]);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'sport_type']);
    }

    /**
     * Test: Team show - sikeres lekérés
     */
    public function test_authenticated_user_can_get_single_team(): void
    {
        $auth = $this->authenticatedUser();
        $team = Team::factory()->create(['name' => 'Test Team']);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->getJson('/api/teams/' . $team->id);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => ['id', 'name', 'sport_type', 'max_members', 'members_count', 'members'],
            ])
            ->assertJsonPath('data.id', $team->id)
            ->assertJsonPath('data.name', 'Test Team');
    }

    /**
     * Test: Team show - nem létező team
     */
    public function test_get_single_team_fails_with_nonexistent_id(): void
    {
        $auth = $this->authenticatedUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->getJson('/api/teams/99999');

        $response->assertStatus(404);
    }

    /**
     * Test: Team update (PUT) - sikeres teljes frissítés
     */
    public function test_authenticated_user_can_update_team_with_put(): void
    {
        $auth = $this->authenticatedUser();
        $team = Team::factory()->create([
            'name' => 'Old Name',
            'sport_type' => 'football',
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->putJson('/api/teams/' . $team->id, [
            'name' => 'New Name',
            'sport_type' => 'basketball',
            'max_members' => 12,
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Team updated successfully',
                'data' => [
                    'name' => 'New Name',
                    'sport_type' => 'basketball',
                    'max_members' => 12,
                ],
            ]);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'name' => 'New Name',
            'sport_type' => 'basketball',
        ]);
    }

    /**
     * Test: Team partial update (PATCH) - sikeres részleges frissítés
     */
    public function test_authenticated_user_can_update_team_with_patch(): void
    {
        $auth = $this->authenticatedUser();
        $team = Team::factory()->create([
            'name' => 'Original Name',
            'sport_type' => 'football',
            'max_members' => 10,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->patchJson('/api/teams/' . $team->id, [
            'name' => 'Updated Name',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Team updated successfully',
                'data' => [
                    'name' => 'Updated Name',
                    'sport_type' => 'football', // nem változott
                    'max_members' => 10, // nem változott
                ],
            ]);

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'name' => 'Updated Name',
            'sport_type' => 'football',
        ]);
    }

    /**
     * Test: Team delete - sikeres törlés
     */
    public function test_authenticated_user_can_delete_team(): void
    {
        $auth = $this->authenticatedUser();
        $team = Team::factory()->create();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->deleteJson('/api/teams/' . $team->id);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Team deleted successfully',
            ]);

        $this->assertSoftDeleted('teams', [
            'id' => $team->id,
        ]);
    }

    /**
     * Test: Team delete - nem létező team
     */
    public function test_delete_team_fails_with_nonexistent_id(): void
    {
        $auth = $this->authenticatedUser();

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $auth['token'],
        ])->deleteJson('/api/teams/99999');

        $response->assertStatus(404);
    }

    /**
     * Test: Team CRUD - token nélkül minden művelet fail
     */
    public function test_all_team_operations_fail_without_authentication(): void
    {
        $team = Team::factory()->create();

        // GET lista
        $this->getJson('/api/teams')->assertStatus(401);
        
        // POST create
        $this->postJson('/api/teams', [
            'name' => 'Test',
            'sport_type' => 'football',
        ])->assertStatus(401);
        
        // GET single
        $this->getJson('/api/teams/' . $team->id)->assertStatus(401);
        
        // PUT update
        $this->putJson('/api/teams/' . $team->id, [
            'name' => 'Updated',
            'sport_type' => 'basketball',
        ])->assertStatus(401);
        
        // PATCH partial update
        $this->patchJson('/api/teams/' . $team->id, [
            'name' => 'Updated',
        ])->assertStatus(401);
        
        // DELETE
        $this->deleteJson('/api/teams/' . $team->id)->assertStatus(401);
    }
}

