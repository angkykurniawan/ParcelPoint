<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class SecurityUserController extends Controller
{
    public function index()
    {
        // Menggunakan query() agar tidak dideteksi error "not enough arguments" oleh VS Code
        $securityUsers = User::query()->where('role', 'security')->paginate(10);
        return view('admin.security.index', compact('securityUsers'));
    }

    public function create()
    {
        return view('admin.security.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'security',
        ]);

        return redirect()->route('admin.security.index')->with('success', 'Akun Security berhasil didaftarkan!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.security.index')->with('success', 'Akun Security sukses dihapus!');
    }
}
