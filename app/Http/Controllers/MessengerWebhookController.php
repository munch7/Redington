<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MessengerWebhookController extends Controller
{
    public function verifyWebhook(Request $request)
    {
        $verifyToken = env('FACEBOOK_VERIFY_TOKEN');
        $hubVerifyToken = $request->input('hub_verify_token');
        $challenge = $request->input('hub_challenge');

        if ($hubVerifyToken === $verifyToken) {
            return response($challenge, 200);
        }
        return response('Invalid verification token', 403);
    }

    public function handleWebhook(Request $request)
    {
        // Handle the incoming webhook events (messages, reactions, etc.)
        \Log::info('Webhook Event: ', $request->all());
        // You can process the message or event further here
    }
}
