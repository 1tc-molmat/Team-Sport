<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of all teams.
     */
    public function index()
    {
        $teams = Team::with('users')->paginate(15);

        return \App\Http\Resources\TeamResource::collection($teams);
    }

    /**
     * Store a newly created team.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sport_type' => 'required|string|max:255',
            'max_members' => 'nullable|integer|min:1|max:100',
        ]);

        $team = Team::create([
            'name' => $validated['name'],
            'sport_type' => $validated['sport_type'],
            'max_members' => $validated['max_members'] ?? 10,
        ]);

        return response()->json([
            'message' => 'Team created successfully',
            'data' => $team->load('users'),
        ], 201);
    }

    /**
     * Display the specified team.
     */
    public function show(Team $team)
    {
        return new \App\Http\Resources\TeamResource($team->load('users'));
    }

    /**
     * Update the specified team (PUT or PATCH).
     */
    public function update(Request $request, Team $team)
    {
        // PATCH részleges frissítés támogatása
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'sport_type' => 'sometimes|string|max:255',
            'max_members' => 'sometimes|integer|min:1|max:100',
        ]);

        $team->update($validated);

        return response()->json([
            'message' => 'Team updated successfully',
            'data' => $team->load('users'),
        ]);
    }

    /**
     * Partially update the specified team (PATCH - partial update).
     */
    public function partialUpdate(Request $request, Team $team)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'sport_type' => 'sometimes|string|max:255',
            'max_members' => 'sometimes|integer|min:1|max:100',
        ]);

        $team->update($validated);

        return response()->json([
            'message' => 'Team partially updated successfully',
            'data' => $team->load('users'),
        ]);
    }

    /**
     * Remove the specified team.
     */
    public function destroy(Team $team)
    {
        $team->delete();

        return response()->json([
            'message' => 'Team deleted successfully',
        ]);
    }
}
