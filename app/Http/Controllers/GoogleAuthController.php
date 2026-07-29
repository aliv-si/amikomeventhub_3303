<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle(Request $request, $eventId)
    {
        \Log::info('Redirecting to Google for event: ' . $eventId);
        // Kita kirim event_id melalui parameter 'state' ke Google agar dikembalikan saat callback
        return Socialite::driver('google')->stateless()->with(['state' => $eventId])->redirect();
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback(Request $request)
    {
        \Log::info('Google Callback Hit. State: ' . $request->input('state'));
        
        try {
            $user = Socialite::driver('google')->stateless()->user();
            
            \Log::info('Google User Found: ' . $user->getEmail());
            
            // Simpan nama dan email dari akun Google ke dalam session
            session([
                'google_name' => $user->getName(),
                'google_email' => $user->getEmail(),
            ]);

            // Ambil event_id dari state parameter yang dikirim balik oleh Google
            $eventId = $request->input('state');
            
            if ($eventId) {
                return redirect()->route('checkout.create', $eventId)->with('success', 'Data berhasil diisi otomatis menggunakan akun Google.');
            }

            return redirect('/')->with('error', 'Sesi checkout tidak ditemukan (State hilang).');
            
        } catch (\Exception $e) {
            \Log::error('Google Login Error: ' . $e->getMessage());
            
            $eventId = $request->input('state');
            if ($eventId) {
                return redirect()->route('checkout.create', $eventId)->with('error', 'Gagal memuat data dari Google.');
            }
            
            return redirect('/')->with('error', 'Gagal memuat data dari Google.');
        }
    }
}
