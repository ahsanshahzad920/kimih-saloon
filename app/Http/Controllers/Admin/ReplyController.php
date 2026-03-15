<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reply;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    public function store(Request $request, $commentId)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $reply = Reply::create([
            'comment_id' => $commentId,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Reply added successfully');
    }
}
