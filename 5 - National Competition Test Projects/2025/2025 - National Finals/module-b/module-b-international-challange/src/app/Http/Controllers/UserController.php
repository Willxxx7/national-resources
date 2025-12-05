<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\CreateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Lists all users.
     */
    public function index()
    {
        $users = User::paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(CreateUserRequest $request)
    {
        // Get all validated data, including the plain-text password
        $data = $request->only(['name', 'email', 'password']);

        User::create($data);

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent deleting currently logged-in user
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->withErrors(['error' => 'You cannot delete your own account.']);
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Suspend the specified user.
     */
    public function suspend(User $user)
    {
        // Prevent suspending currently logged-in user
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->withErrors(['error' => 'You cannot suspend your own account.']);
        }

        $user->suspended_at = now();
        $user->save();

        return redirect()->route('users.index')->with('success', sprintf('User "%s" has been suspended.', $user->name));
    }

    /**
     * Unsuspend the specified user.
     */
    public function unsuspend(User $user)
    {
        $user->suspended_at = null;
        $user->save();

        return redirect()->route('users.index')->with('success', sprintf('User "%s" has been unsuspended.', $user->name));
    }
}
