<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::where('is_admin', true)->orderBy('created_at', 'desc')->get();
        return view('backend.admins.index', compact('users'));
    }

    // Show create form
    public function create()
    {
        return view('backend.admins.create');
    }

    // Store new user
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        Log::info('Validation successful', $validated);

        try {
            // Handle file upload
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $file = $request->file('avatar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('avatars'), $fileName);
                $avatarPath = 'avatars/' . $fileName;
                Log::info('Avatar uploaded', ['path' => $avatarPath]);
            }

            // Create user
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'gender' => $validated['gender'],
                'avatar' => $avatarPath,
                'is_admin' => true,
            ]);

            Log::info('User created successfully', ['user_id' => $user->id]);

            return redirect()->route('backend.admins.index')
                ->with('success', 'Admin berhasil ditambahkan!');

        } catch (\Exception $e) {
            Log::error('Error creating user', ['error' => $e->getMessage()]);
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan admin. ' . $e->getMessage());
        }
    }

    // Show user details
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('backend.admins.show', compact('user'));
    }

    // Show edit form
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.admins.edit', compact('user'));
    }

    // Update user details
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'gender' => 'required|in:Laki-laki,Perempuan',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('avatar')) {
                // Delete old avatar
                if ($user->avatar) {
                    if (file_exists(public_path($user->avatar))) {
                        unlink(public_path($user->avatar));
                    }
                }

                $file = $request->file('avatar');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('avatars'), $fileName);
                $validated['avatar'] = 'avatars/' . $fileName;
            }

            // Update user data
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'gender' => $validated['gender']
            ];

            // Update password if provided
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->password);
            }

            // Update avatar if provided
            if (isset($validated['avatar'])) {
                $userData['avatar'] = $validated['avatar'];
            }

            $user->update($userData);

            return redirect()->route('backend.admins.index')
                ->with('success', 'Admin berhasil diperbarui!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui admin. ' . $e->getMessage());
        }
    }

    // Delete a user
    public function destroy($id)
    {
        try {
            // Coba temukan user dengan ID yang diberikan
            $user = User::find($id);

            // Jika user tidak ditemukan, kembalikan pesan error
            if (!$user) {
                return redirect()->route('backend.admins.index')
                    ->with('error', 'Gagal menghapus admin. No query results for model [App\\Models\\User] ' . $id);
            }

            // Delete avatar file if exists
            if ($user->avatar) {
                if (file_exists(public_path($user->avatar))) {
                    unlink(public_path($user->avatar));
                }
            }

            $user->delete();

            return redirect()->route('backend.admins.index')
                ->with('success', 'Admin berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('backend.admins.index')
                ->with('error', 'Gagal menghapus admin. ' . $e->getMessage());
        }
    }

    // Show authenticated user's profile
    public function profile()
    {
        $user = Auth::user();
        return view('backend.admins.profile', compact('user'));
    }
}
