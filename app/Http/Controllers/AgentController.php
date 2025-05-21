<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agents = User::where('role', 'agent')->paginate(10);
        return view('agents.index', compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Split the full name into first and last name
        $nameParts = explode(' ', $request->name, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        // Generate username from email (before the @ symbol)
        $username = explode('@', $request->email)[0];
        $baseUsername = $username;
        $counter = 1;

        // Check if username exists and generate a unique one
        while (User::where('username', $username)->exists()) {
            $username = $baseUsername . $counter;
            $counter++;
        }

        try {
            $user = User::create([
                'first_name' => $firstName,
                'last_name' => $lastName,
                'username' => $username,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
                'role' => 'agent',
                'status' => 'ACTIVE',
            ]);

            return redirect()->route('agents.index')
                ->with('success', 'Agent créé avec succès.');
        } catch (\Exception $e) {
            return redirect()->route('agents.index')
                ->with('error', 'Erreur lors de la création de l\'agent : ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $agent)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$agent->id],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        // Split the full name into first and last name
        $nameParts = explode(' ', $request->name, 2);
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? $nameParts[1] : '';

        // Generate new username only if name has changed
        $updateData = [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => $request->has('is_active') ? 'ACTIVE' : 'NON_ACTIVE',
        ];

        // Update username if name has changed
        if ($agent->first_name !== $firstName || $agent->last_name !== $lastName) {
            $baseUsername = strtolower($firstName . ($lastName ? '.' . $lastName : ''));
            $username = $baseUsername;
            $counter = 1;

            while (User::where('username', $username)->where('id', '!=', $agent->id)->exists()) {
                $username = $baseUsername . $counter;
                $counter++;
            }

            $updateData['username'] = $username;
        }

        $success = $agent->update($updateData);

        if (!$success) {
            return redirect()->route('agents.index')
                ->with('error', 'Erreur lors de la mise à jour de l\'agent.');
        }

        return redirect()->route('agents.index')
            ->with('success', 'Agent mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $agent)
    {
        $agent->delete();

        return redirect()->route('agents.index')
            ->with('success', 'Agent supprimé avec succès.');
    }
}
