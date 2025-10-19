<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function welcome(Request $request)
    {
        $comments = Comment::shown()->latest()->paginate(10);

        // CHECK 1: If this is an AJAX request (from Load More button)
        if ($request->ajax()) {
            // Render the partial view for the new page of comments
            $html = view('partials.comment_list', [
                'comments' => $comments->items() // Pass only the collection of items
            ])->render();

            // Return JSON with the HTML and the next page URL
            return response()->json([
                'html' => $html,
                'next_page_url' => $comments->nextPageUrl()
            ]);
        }

        // CHECK 2: If this is the initial full page load
        return view('welcome', [
            'comments' => $comments
        ]);
    }

    public function createComment(Request $request)
    {
        // 1. Validate the incoming data
        $validated = $request->validate([
            'from' => 'required|string|max:255', // Corresponds to the 'from' field (name)
            'text' => 'required|string',        // Corresponds to the 'text' field (message)
            // Note: _token is automatically checked by the VerifyCsrfToken middleware
        ]);

        // 2. Define visibility policy
        // We set 'show' to true/false based on your requirement (defaulting to true for immediate display)
        $showStatus = true; // Change to 'false' if you require admin approval before showing

        // 3. Create the comment in the database
        $comment = Comment::create([
            'from' => $validated['from'],
            'text' => $validated['text'],
            'show' => $showStatus,
        ]);

        // 4. Return a successful JSON response
        // Send back the created object so the JavaScript can update the UI immediately.
        return response()->json([
            'message' => 'Ucapan dan Doa berhasil disimpan.',
            'comment' => $comment
        ], 201);
    }
}
