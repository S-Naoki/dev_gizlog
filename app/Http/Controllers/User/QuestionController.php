<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\QuestionsRequest;
use App\Http\Requests\User\SearchQuestionsRequest;
use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Comment;
use App\Models\tagCategory; 
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    
    protected $question;
    protected $comment;
    protected $tagCategory;
    
    /**
     * コンストラクタメソッド
     *
     * @param Question $question
     * @param Comment $comment
     * @param tagCategory $tagCategory
     */
    public function __construct(Question $question, Comment $comment, tagCategory $tagCategory)
    {
        $this->middleware('auth');
        $this->question = $question;
        $this->comment = $comment;
        $this->tagCategory = $tagCategory;
    }
    
    /**
     * 質問一覧画面を表示します。
     *
     * @param Request $request
     * @return void
     */
    public function index(SearchQuestionsRequest $request)
    {
        $inputs = $request->all();
        $tagCategory = $request->tag_category_id;
        $questions = $this->question->searchQuestions($inputs, $tagCategory);
        $request->flash();
        return view('user.question.index', compact('inputs', 'tagCategory', 'questions'));
    }
    
    /**
     * 質問を新規作成するためのフォームを表示します。
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagCategories = $this->tagCategory->all();
        $tagCategoryArray = $this->fetchTagCategories($tagCategories);
        return view('user.question.create', compact('tagCategoryArray'));
    }
    
    /**
     * 新たに作成された質問をデータベースに格納します。
     *
     * @param  QuestionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionsRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->question->fill($input)->save();
        return redirect()->route('question.index');
    }

    /**
     * 質問詳細画面を表示します。
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
     * 質問を編集するためのフォームを表示します。
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tagCategories = $this->tagCategory->all();
        $tagCategoryArray = $this->fetchTagCategories($tagCategories);
        $question = $this->question->find($id);
        return view('user.question.edit', compact('question', 'tagCategoryArray'));
    }

    /**
     * 編集した質問内容を更新します。
     *
     * @param  QuestionsRequest  $request
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
     * データベースから質問を削除します。
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->question->find($id)->delete();
        return redirect()->route('question.mypage');
    }
    
    /**
     * 確認画面を表示します。
     *
     * @param QuestionsRequest $request
     * @return void
     */
    public function showConfirmation(QuestionsRequest $request)
    {
        $tagCategoryName = $this->tagCategory->find($request->tag_category_id)->name;
        $inputs = $request->all();
        return view('user.question.confirm', compact('tagCategoryName', 'inputs'));
    }

    /**
     * 自分の質問だけのマイページを表示します。
     *
     * @return void
     */
    public function showMypage()
    {
        $questions = $this->question->fetchQuestionsByUserId(Auth::id());
        return view('user.question.mypage', compact('questions'));
    }
        
    private function fetchTagCategories($tagCategories)
    {
        return $tagCategories->pluck('name', 'id')
                    ->prepend('Select Category', 0)
                    ->all();
    }
}
