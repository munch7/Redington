<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FacebookMessagesController extends Controller
{
    public function getMessages(Request $request)
{
    $pageAccessToken = env('FACEBOOK_ACCESS_TOKEN');
    $pageId = '462647006928794';

    // Fetch conversations
    $conversationsResponse = Http::get("https://graph.facebook.com/v12.0/{$pageId}/conversations", [
        'access_token' => $pageAccessToken,
    ]);

    // Log the response for debugging
    \Log::info('Conversations Response:', ['response' => $conversationsResponse->body()]);

    if ($conversationsResponse->successful()) {
        $conversations = $conversationsResponse->json()['data'];

        if (!empty($conversations)) {
            $conversationId = $conversations[0]['id'];

            // Fetch messages for the conversation
            $messagesResponse = Http::get("https://graph.facebook.com/v12.0/{$conversationId}/messages", [
                'access_token' => $pageAccessToken,
            ]);

            // Log the complete messages response for debugging
            \Log::info('Messages Response:', ['response' => $messagesResponse->body()]);

            if ($messagesResponse->successful()) {
                // Check the response structure
                $messages = $messagesResponse->json()['data'] ?? [];

                // Log the messages array
                \Log::info('Fetched Messages:', ['messages' => $messages]);

                return view('welcome', [
                    'messages' => $messages,
                ]);
            } else {
                return view('welcome', [
                    'error' => 'Failed to fetch messages: ' . $messagesResponse->body(),
                ]);
            }
        } else {
            return view('welcome', [
                'error' => 'No conversations found.',
            ]);
        }
    } else {
        return view('welcome', [
            'error' => 'Failed to fetch conversations: ' . $conversationsResponse->body(),
        ]);
    }
}
}
