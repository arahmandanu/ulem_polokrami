<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Lists all comments for the admin view
    public function index()
    {
        $comments = Comment::latest()->paginate(20);
        return view('admin.comments.index', compact('comments'));
    }

    // Shows the form for editing a specific comment
    public function edit(Comment $comment)
    {
        return view('admin.comments.edit', compact('comment'));
    }

    // Handles the update request
    public function update(Request $request, Comment $comment)
    {
        // 1. Handle the quick toggle action from the index page
        if ($request->has('toggle_show')) {
            $comment->update(['show' => $request->input('toggle_show')]);
            $action = $request->input('toggle_show') ? 'shown' : 'hidden';
            return redirect()->route('comments.index')->with('success', "Comment #{$comment->id} status successfully set to {$action}.");
        }

        // 2. Handle the full form update from the edit page
        $validated = $request->validate([
            'from' => 'required|string|max:255',
            'text' => 'required|string',
            'show' => 'boolean', // Will be 1 or null if checkbox is unchecked
        ]);

        // Handle unchecked checkbox (defaults to 0/false)
        $validated['show'] = $request->has('show');

        $comment->update($validated);

        return redirect()->route('admin.comments.index')->with('success', 'Comment updated successfully!');
    }
}
