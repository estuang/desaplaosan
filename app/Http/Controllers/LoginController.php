<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function index()
    {
        return view('adminDashboard.login', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        try{
            $input = $request->all();

            $this->validate($request, [
                'userName' => 'required',
                'password' => 'required',
            ]);

            $authAttempt = auth()->attempt(array('userName' => $input['userName'], 'password' => $input['password']));

            // dd($input['userName'], $input['password']);

            if ($authAttempt) {
                if (auth()->user()->role == 'staff') {
                    return redirect()->route('admin');
                } else if (auth()->user()->role == 'masyarakat') {
                    return redirect()->route('masyarakat');
                }
            } else {
                return redirect()->route('login')
                    ->with('error', 'Email-Address And Password Are Wrong.');
            }
            } catch (QueryException $e) {
            // Menangkap kesalahan query (misalnya field tidak ditemukan di DB)
            // Log laravel
            Log::error('QueryException saat login:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }


    public function logout()
    {
        Auth::logout();
        Request()->session()->invalidate();
        Request()->session()->regenerate();

        return redirect('/login');
    }
}
