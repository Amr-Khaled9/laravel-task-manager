<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AIController extends Controller
{
    public function summarize(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255'
        ]);

        $response = Http::withToken(trim(env('OPENAI_API_KEY')))
            ->post('https://api.openai.com/v1/chat/completions', [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => 'You are a helpful AI assistant for task management.'],
                    ['role' => 'user', 'content' => $request->text],
                ]
            ]);


        $data = $response->json();
        if (isset($data['error'])) {
            $aiResponse = '❌ API Error: ' . ($data['error']['message'] ?? 'Unknown error');
        } else {
            $aiResponse = $data['choices'][0]['message']['content'] ?? '⚠️ No response content.';
        }


        return view('AI', ['response' => $aiResponse]);
    }
}
