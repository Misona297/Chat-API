<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\MessageValidation;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::with('user')->get();
    
        return response(MessageCollection::make($messages), Response::HTTP_OK);
    }
    
    public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:50',
        'content' => 'required|string|max:255'
    ]);

    $message = Auth::user()->messages()->create($validated);

    return response($message, Response::HTTP_CREATED);
}

public function show($messageId)
{
    $message = Message::with('user')->findOrFail($messageId);

    return response(MessageResource::make($message), Response::HTTP_OK);
}


    public function update(Request $request, $messageId)
{
    $validated = $request->validate([
        'title' => 'required|string|max:50',
        'content' => 'required|string|max:255'
    ]);

    $message = Auth::user()->messages()->findOrFail($messageId);

    $message->update($validated);

    return response($messages, Response::HTTP_OK);
}

public function destroy($messageId)
{
    $message = Auth::user()->messages()->findOrFail($messageId);

    $message->delete();

    return response([
        'message'=>'message has deleted.'
    ],Response::HTTP_OK);
}

}
