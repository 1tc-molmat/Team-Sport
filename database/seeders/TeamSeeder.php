<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Igazi user létrehozása: mate / Mate123
        $mate = User::create([
            'name' => 'Máté',
            'email' => 'mate@example.com',
            'password' => Hash::make('Mate123'),
            'sport_type' => 'football',
            'skill_level' => 'expert',
        ]);

        // 2. 10 fake user létrehozása Factory-val
        $fakeUsers = User::factory()->count(10)->create();

        // 3. Összes user (mate + 10 fake = 11 user)
        $allUsers = collect([$mate])->merge($fakeUsers);

        // 4. 10 fake team létrehozása Factory-val
        $teams = Team::factory()->count(10)->create();

        // 5. Random kapcsolatok létrehozása users és teams között
        $roles = ['captain', 'member', 'vice-captain'];
        
        $teams->each(function ($team) use ($allUsers, $roles) {
            // Minden csapathoz random 2-5 tag
            $membersCount = rand(2, 5);
            $selectedUsers = $allUsers->random(min($membersCount, $allUsers->count()));
            
            $selectedUsers->each(function ($user, $index) use ($team, $roles) {
                $team->users()->attach($user->id, [
                    'role' => $index === 0 ? 'captain' : fake()->randomElement($roles),
                    'joined_at' => now()->subDays(rand(1, 365)),
                ]);
            });
        });

        // 6. Mate-t berakjuk legalább 2 csapatba captain-ként
        $mateTeams = $teams->random(2);
        foreach ($mateTeams as $team) {
            if (!$team->users->contains($mate->id)) {
                $team->users()->attach($mate->id, [
                    'role' => 'captain',
                    'joined_at' => now()->subDays(rand(30, 90)),
                ]);
            }
        }

        $this->command->info('✅ Seeding befejezve: 1 igazi user (mate) + 10 fake user + 10 fake team + kapcsolatok!');
    }
}
