<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

class ViberController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string',
            'number' => 'required|string',
        ]);

        $message = $request->message;
        $number = $request->number;
        $token = config('services.viber.token');

        try {
            $response = Http::withoutVerifying()
                ->withHeaders(['X-Viber-Auth-Token' => $token])
                ->post('https://chatapi.viber.com/pa/send_message', [
                    'receiver' => $number, // Viber user ID or phone number (with country code)
                    'type' => 'text',
                    'text' => $message, // The message content
                    'sender' => [
                        'name' => config('Orchard', 'Orchard Golf Reservation1'), // You can customize the sender name here
                    ],
                    'min_api_version' => 1,
                ]);

            $body = $response->json();

            // Viber API returns HTTP 200 even on errors; check its own status field (0 = success)
            if ($response->successful() && isset($body['status']) && $body['status'] === 0) {
                return response()->json(['status' => 'success', 'viber_response' => $body]);
            } else {
                return response()->json(['status' => 'error', 'message' => $body['status_message'] ?? $response->body(), 'viber_response' => $body]);
            }
        } catch (ConnectionException $e) {
            return response()->json(['status' => 'error', 'message' => 'Connection failed: ' . $e->getMessage()], 500);
        }
    }
}
