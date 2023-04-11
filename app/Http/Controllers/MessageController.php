<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class MessageController extends Controller
{
    public function mailbox(Request $request)
    {
        $user = Auth::user();
        $conversations = DB::select('SELECT u.id, u.name, u.slug, (
                                        SELECT MAX(created_at) 
                                          FROM messages
                                         WHERE (recipient_id = u.id AND sender_id = ?)
                                            OR (sender_id = u.id AND recipient_id = ?)
                                    ) latest_message,
                                    (
                                        SELECT COUNT(*) FROM messages
                                         WHERE recipient_id = ?
                                           AND sender_id = u.id 
                                           AND is_read = 0
                                    ) unread_messages
                                    FROM users u
                                    WHERE id IN (
                                        SELECT recipient_id FROM messages WHERE sender_id = ?
                                        UNION 
                                        SELECT sender_id FROM messages WHERE recipient_id = ?
                                    )
                                    ORDER BY latest_message DESC',
        [$user->id, $user->id, $user->id, $user->id, $user->id]
    );
        
        return view('messages.mailbox', compact('conversations'));
    }

    public function conversation(Request $request, $slug)
    {
        // Retrieve all messages sent to or received from the specified user
        $user = Auth::user();
        $other= User::where('slug',$slug)->first();
        $messages = Message::where(function ($query) use ($user, $other) {
                                $query->where('sender_id', '=', $user->id)
                                   ->where('recipient_id', '=', $other->id);
                                })
                                ->orWhere(function ($query) use ($user, $other) {
                                    $query->where('sender_id', '=', $other->id)
                                        ->where('recipient_id', '=', $user->id);
                                })
                                ->orderBy('created_at')
                                //->toSql();
                                ->get();

                                

        Message::where('recipient_id', $user->id)
                ->where('sender_id', $other->id)
                ->update(['is_read' => 1]);


        return view('messages.conversation', compact('messages','user','other'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'body' => 'required|string',
            'recipient_id' => 'required|exists:users,id',
        ]);

        $recipient = User::find($validatedData['recipient_id']);

        // Create a new message instance
        $message = new Message;
        $message->body = $validatedData['body'];
        $message->recipient_id = $validatedData['recipient_id'];
        $message->sender_id = Auth::id(); // Set the sender ID to the authenticated user's ID

        // Save the message to the database
        $message->save();

        // Return a response
        //return response()->json(['success' => 'Message sent successfully']);
        return redirect()->route('messages.conversation',$recipient->slug)->with('success', 'Message sent successfully');
    }
}