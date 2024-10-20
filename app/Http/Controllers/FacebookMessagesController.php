<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FacebookMessagesController extends Controller
{
    private $pageAccessToken;
    private $pageId;

    public function __construct()
    {
        $this->pageAccessToken = env('FACEBOOK_PAGE_ACCESS_TOKEN');
        $this->pageId = env('FACEBOOK_APP_ID');  // Use the app ID to get the page ID if needed
    }

    public function getConversations(Request $request)
    {
        $response = Http::get("https://graph.facebook.com/v21.0/162237190493977/conversations", [
            'access_token' => $this->pageAccessToken,
        ]);

        if ($response->successful()) {
            $conversations = $response->json()['data'] ?? [];
            return view('messages', ['conversations' => $conversations]);
        } else {
            Log::error('Failed to fetch conversations:', [
                'status_code' => $response->status(),
                'response_body' => $response->body(),
                'error_details' => $response->json(),
                'url' => $response->effectiveUri(),
                'access_token' => $this->pageAccessToken
            ]);
    
            return response()->json(['error' => 'Failed to fetch conversations. Please check the logs for more details.'], 500);
        }
    }

    //public function getMessages($conversationId)
   // {
    //    $response = Http::get("https://graph.facebook.com/v15.0/{$conversationId}/messages", [
     //       'access_token' => $this->pageAccessToken,
     //   ]);

    //    if ($response->successful()) {
     //       return response()->json($response->json()['data'] ?? []);
     //   } else {
    //        Log::error('Failed to fetch messages for conversation ID: ' . $conversationId, [
    //            'error' => $response->json(),
    //        ]);
    //        return response()->json(['error' => 'Failed to fetch messages.'], 500);
    //    }
    //}

    //public function replyToMessage(Request $request, $messageId)
    //{
      //  $validatedData = $request->validate([
        //    'message' => 'required|string|max:500',
        //]);

        //$response = Http::post("https://graph.facebook.com/v15.0/{$messageId}/messages", [
          //  'access_token' => $this->pageAccessToken,
           // 'message' => $validatedData['message'],
        //]);

        //if ($response->successful()) {
          //  return response()->json(['success' => 'Message sent successfully.']);
        //} else {
            //Log::error('Failed to send message:', ['error' => $response->json()]);
            //return response()->json(['error' => 'Failed to send message.'], 500);
        //}
    //}
}
