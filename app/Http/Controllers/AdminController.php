<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function users()
    {
        $users = User::where('role', '!=', 'Administrator')->get();

        return view('admin.users', compact('users'));
    }

    public function edit(Request $request)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
            'role' => 'required|in:Administrator,Teacher,Student,Mentor',
        ]);

        $user = User::findOrFail($request->userId);
        $user->role = $request->role;
        $user->save();

        return response()->json(['success' => true]);
    }
}
