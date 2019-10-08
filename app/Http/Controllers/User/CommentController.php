<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    protected $comment;
    
    public function __construct(Comment $comment)
    {
        $this->middleware('auth');
        $this->comment = $comment;
    }
    public function store(Request $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->comment->create($inputs);
        return redirect()->route('question.show', $request->question_id);
        
    }
}
