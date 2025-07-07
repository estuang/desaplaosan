<?php

namespace App\Http\Controllers\warga;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class WargaMyAccountController extends Controller
{
    public function myAcount()
    {
        return view('wargaDashboard.WargaMyAcount', [
            'title' => 'My Acount',
            'user' => Auth::user()
        ]);
    }

    public function updateMyAcount(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'max:255',
            'userName' => 'max:255',
            'role' => 'max:255',
            'alamat' => 'max:255',
        ]);

        // Update data user (tanpa password)
        User::where('id', $id)->update($validatedData);

        // Jika password lama dan password baru diisi, lakukan update password
        if ($request->filled('password_lama') && $request->filled('password_baru')) {
            $currentPasswordStatus = Hash::check($request->password_lama, auth()->user()->password);
            if ($currentPasswordStatus) {
                User::findOrFail(Auth::user()->id)->update([
                    'password' => Hash::make($request->password_baru),
                ]);
                return redirect('Warga/myAcount')->with('successUpdatedAcount', 'Password dan data akun berhasil diperbaharui');
            } else {
                return redirect('Warga/myAcount')->with('failUpdatedAcount', 'Password lama tidak valid');
            }
        }

        return redirect('Warga/myAcount')->with('successUpdatedAcount', 'Akun berhasil diperbaharui');
    }
}
