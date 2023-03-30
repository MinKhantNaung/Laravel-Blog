<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // to create comments
    public function create(Request $request) {
        $request->validate([
            'content' => 'required',
            'article_id' => 'required',
        ], [
            'content.required' => 'New comment field must be filled',
        ]);

        Comment::create([
            'content' => $request->content,
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id,
        ]);

        return back();
    }

    // to delete comment
    public function delete($id) {
        $comment = Comment::find($id);

        if(Gate::allows('comment-delete', $comment)) {
            $comment->delete();
            return back();
        } else {
            return back()->with('Error', 'Unauthorize');
        }
    }
}
