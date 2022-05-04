<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function index($id)
    {
        return Comment::where('post_id', $id)->get();
    }
    public function store(Request $request)
    {
        $comment =  Comment::create([
            'post_id' => $request->input('post_id'),
            'text' => $request->input('text')
        ]);

        $req = \Http::post("http://localhost:8000/api/posts/{$comment->post_id}/comments", [
            'text' => $comment->text
        ]);

        if($req->failed()){
            return 'Request Failed!';
        }

        return $comment;
    }
}
