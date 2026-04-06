<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    public function dashboard() {
        return view('staff.dashboard');
    }

    public function index()
    {
        $staffs = User::where('role', 'staff')->latest()->paginate(5);

        return view('staffs.index', compact('staffs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        return view('staffs.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'staff',
        ]);

        return redirect()->route('staffs.index')
            ->with('success', 'Staff created successfully.');
    }

    public function show(User $staff)
    {
        return view('staffs.show', compact('staff'));
    }

    public function edit(User $staff)
    {
        return view('staffs.edit', compact('staff'));
    }

    public function update(Request $request, User $staff): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $staff->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $staff->update($data);

        return redirect()->route('staffs.index')
            ->with('success', 'Staff updated successfully');
    }

    public function destroy(User $staff)
    {
        $staff->delete();

        return redirect()->route('staffs.index')
            ->with('success', 'Staff deleted successfully');
    }
}
