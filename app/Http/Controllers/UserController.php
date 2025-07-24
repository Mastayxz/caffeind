<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    //
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'image' => $request->file('image') ? $request->file('image')->store('images', 'public') : $user->image,
        ]);


        $user->customers()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $validated['address'] ?? '',
                'phone' => $validated['phone'] ?? '',
            ]
        );


        return redirect()->route('account.profile')->with('success', 'Profil berhasil diperbarui.');
    }

    public function show()
    {
        $user = Auth::user();
        return view('account.profile', compact('user'));
    }
}
