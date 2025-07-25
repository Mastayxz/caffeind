<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'user')->count();
        $order = Order::all()->count();
        $produk = Product::all()->count();
        $kategori = Category::all()->count();
        $admin = Auth::user();
        // dd($)
        return view('admin.dashboard', compact('user', 'order','produk', 'kategori', 'admin' ));
    }

    public function showUser(Request $request)
    {
        $search = $request->input('search');

        $user = User::with('customers')
            ->where('role', 'user')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.user', compact('user', 'search'));
    }
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:100|unique:users,email,' . $id,
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
        if ($user->customers) {
            $user->customers->update([
                'address' => $request->address,
                'phone'   => $request->phone,
            ]);
        } else {
            $user->customers()->create([
                'address' => $request->address,
                'phone'   => $request->phone,
            ]);
        }

        return redirect()->back()->with('success', 'User berhasil diperbarui.');
    }

    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasil dihapus.');
    }
}
