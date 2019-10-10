<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Comment;
use App\Models\tagCategory; 
use Auth;


class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $question;
    protected $comment;
    protected $tagCategory;
    
    
    public function __construct(Question $question, Comment $comment, tagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->comment = $comment;
        $this->tagCategory = $tagCategory;
    }
    
    public function index(Request $request)
    {
        $inputs = $request->all();
        $tagCategories = $request->tag_category_id;
        $questions = $this->question->searchQuestion($inputs, $tagCategories);
        $request->flash();
        return view('user.question.index', compact('inputs', 'tagCategories', 'questions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.question.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\User\QuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->create($input);
        return redirect()->route('question.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = $this->question->find($id);
        $user = Auth::user();
        return view('user.question.show', compact('question', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\User\QuestionsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $this->question->find($id)->update($inputs);
        return redirect()->route('question.mypage');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.mypage');
    }
    
        
    public function showConfirmation(QuestionsRequest $request)
    {
        $tagCategoryName = $this->tagCategory->find($request->tag_category_id)->name;
        $inputs = $request->all();
        return view('user.question.confirm', compact('tagCategoryName', 'inputs'));
    }

    public function showMypage()
    {
        $questions = $this->question->fetchQuestionsByUserId(Auth::id());
        return view('user.question.mypage', compact('questions'));
    }
}
