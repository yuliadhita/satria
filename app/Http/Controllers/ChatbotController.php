<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Google_Client;
use Google_Service_Gemini;

class ChatbotController extends Controller
{
    // Fungsi untuk mendapatkan access token
    public function getAccessToken(Request $request)
    {
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials/your_client_secret.json'));  // Path ke file kredensial JSON
        $client->addScope('https://www.googleapis.com/auth/cloud-platform'); // Scope untuk Google Gemini API
        $client->setRedirectUri('http://127.0.0.1:8000/chatbot/callback'); // URL pengalihan setelah otorisasi

        // Cek apakah authorization code ada di URL
        if (isset($_GET['code'])) {
            // Tukarkan authorization code dengan access token
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $_SESSION['access_token'] = $token;

            // Redirect kembali ke halaman aplikasi setelah mendapatkan token
            return redirect('/'); // Ganti dengan URL yang sesuai
        }

        // Jika token sudah ada, set access token di client
        if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
            $client->setAccessToken($_SESSION['access_token']);
        }

        // Jika tidak ada token, arahkan pengguna untuk login
        if (!$client->getAccessToken()) {
            $authUrl = $client->createAuthUrl();
            return response()->json(['auth_url' => $authUrl], 401);  // Mengarahkan ke URL otorisasi
        }

        // Setelah mendapatkan access token, Anda dapat menggunakannya untuk membuat request ke API Gemini atau lainnya
        $accessToken = $client->getAccessToken();
        return response()->json(['access_token' => $accessToken]);
    }

    public function handleCallback(Request $request)
    {
        // Inisialisasi Google Client
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials/your_client_secret.json')); // Path ke file kredensial JSON
        $client->addScope('https://www.googleapis.com/auth/cloud-platform'); // Scope untuk Google Gemini API

        // Ambil kode otorisasi dari URL
        $code = $request->input('code');
        
        if ($code) {
            // Tukarkan kode otorisasi dengan access token
            $token = $client->fetchAccessTokenWithAuthCode($code);

            // Simpan access token ke sesi atau database
            session(['access_token' => $token]);

            // Redirect kembali ke halaman utama atau halaman chatbot
            return redirect('/chatbot'); // Ganti dengan halaman yang sesuai
        }

        // Jika kode otorisasi tidak ada
        return redirect('/')->with('error', 'Authorization failed!');
    }

    // Fungsi untuk mengirim pesan ke Google Gemini
    public function sendMessage(Request $request)
    {
        $input = $request->input('prompt', '');

        // Pastikan ada input
        if (empty($input)) {
            return response()->json(['message' => 'Prompt tidak boleh kosong.'], 400);
        }

        // Autentikasi dengan Google Client
        $client = new Google_Client();
        $client->setAuthConfig(storage_path('credentials/your_client_secret.json'));
        $client->addScope('https://www.googleapis.com/auth/cloud-platform'); // Menambahkan scope untuk Google Gemini
        $client->useApplicationDefaultCredentials();
        
        // Cek apakah token sudah ada, jika tidak arahkan untuk mendapatkan kode otorisasi
        if ($client->getAccessToken()) {
            $accessToken = $client->getAccessToken();
        } else {
            // Proses pengambilan token jika belum ada
            $authUrl = $client->createAuthUrl();
            return response()->json(['auth_url' => $authUrl], 401);  // Mengarahkan ke URL otorisasi
        }

        try {
            // Kirim request ke Gemini API dengan token yang sudah didapat
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken['access_token'],  // Token akses yang sudah didapat
                'Content-Type' => 'application/json',
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent', [
                'contents' => [
                    [
                        'parts' => [
                            [
                                'text' => "Pertanyaan pengguna: {$input}\n\nBerikan jawaban yang ringkas, jelas, relevan, dan jika perlu sertakan rujukan resmi BPS."
                            ],
                        ],
                    ],
                ],
            ]);

            // Mengecek apakah response berhasil
            if ($response->successful()) {
                $data = $response->json();
                // Mendapatkan teks balasan dari Gemini API
                $botMessage = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Tidak ada respon dari Gemini.';
            } else {
                $botMessage = 'Terjadi kesalahan dalam memproses jawaban dari Gemini.';
            }

            // Mengembalikan hasil dari chatbot
            return response()->json(['message' => $botMessage]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi error: ' . $e->getMessage()], 500);
        }
    }
}
