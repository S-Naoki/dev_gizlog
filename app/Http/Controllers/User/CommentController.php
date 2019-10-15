<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\User\CommentRequest;

class CommentController extends Controller
{
    protected $comment;
    
    /**
     * コンストラクタメソッド
     *
     * @param Comment $comment
     */
    public function __construct(Comment $comment)
    {
        $this->middleware('auth');
        $this->comment = $comment;
    }
    
    /**
     * 作成されたコメントをデータベースに格納。
     *
     * @param Request $request
     * @return void
     */
    public function store(CommentRequest $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->comment->create($inputs);
        return redirect()->route('question.show', $request->question_id);
    }
}
