<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function ask(Request $request)
    {
        $message = $request->input('message');

        // Cek keyword manual (knowledge base sederhana)
        $training = [
            "penduduk" => "https://tulungagungkab.bps.go.id/indicator/12/1/1/jumlah-penduduk.html",
            "inflasi" => "https://tulungagungkab.bps.go.id/indicator/3/2/1/inflasi.html",
            "ipm" => "https://tulungagungkab.bps.go.id/indicator/26/1/1/indeks-pembangunan-manusia.html",
            "kontak" => "https://tulungagungkab.bps.go.id/kontak.html"
        ];

        foreach ($training as $key => $url) {
            if (stripos($message, $key) !== false) {
                return response()->json(['reply' => "Informasi tentang $key bisa diakses di sini: $url"]);
            }
        }

        // Jika tidak cocok keyword → lempar ke AI API
        $apiKey = env('OPENAI_API_KEY'); // atau GEMINI_API_KEY
        $response = Http::withToken($apiKey)->post("https://api.openai.com/v1/chat/completions", [
            "model" => "gpt-3.5-turbo",
            "messages" => [
                ["role" => "system", "content" => "Anda adalah Chatbot BPS Kabupaten Tulungagung yang membantu pelayanan statistik."],
                ["role" => "user", "content" => $message]
            ]
        ]);

        $reply = $response->json()['choices'][0]['message']['content'] ?? "Maaf, saya tidak bisa menjawab pertanyaan itu.";

        return response()->json(['reply' => $reply]);
    }
}
