<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    /**
     * Send WhatsApp message using a free service (e.g., CallMeBot)
     *
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function sendMessage($phone, $message)
    {
        if (empty($phone)) {
            return false;
        }

        // Clean phone number (remove +, spaces, etc)
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // For a completely free solution for personal/test projects, CallMeBot is a great option.
        // Get your API key by sending a WhatsApp message to CallMeBot.
        $apiKey = env('WHATSAPP_API_KEY');

        if (!$apiKey) {
            // Log it for development if no API key is provided
            Log::info("Simulating WhatsApp message to {$phone}: {$message}");
            return true;
        }

        try {
            // Using CallMeBot free API
            $response = Http::get('https://api.callmebot.com/whatsapp.php', [
                'phone' => $phone,
                'text' => $message,
                'apikey' => $apiKey,
            ]);

            return $response->successful();
        } catch (\Exception $e) {
            Log::error("Failed to send WhatsApp message: " . $e->getMessage());
            return false;
        }
    }
}
