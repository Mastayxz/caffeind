<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {

        return view('admin.dashboard');
    }

  public function showUser(Request $request)
{
    $query = User::query();

    if ($request->has('search')) {
        $search = $request->search;
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
    }

    $user = $query->paginate(10); // Batas 10 user per halaman

    return view('admin.user', compact('user'));
}

    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255|unique:users,email,' . $id,
            'address' => 'nullable|string|max:255',
            'phone'   => 'nullable|string|max:20',
        ]);

        $user = User::findOrFail($id);

        // Update data utama user
        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        // Update relasi customers (alamat dan telepon)
        $user->customers->update([
            'address' => $request->address,
            'phone'   => $request->phone,
        ]);


        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
