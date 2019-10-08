@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm']) !!}
    {!! Form::hidden('confirm', 'create') !!}
      <div class="form-group @if(!empty($errors->has('tag_category_id'))) has-error @endif">
        {!! Form::select('tag_category_id', ['Select category', 'front', 'back', 'infra', 'others'], ['Select category'], ['class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->has('title'))) has-error @endif">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if(!empty($errors->has('content'))) has-error @endif">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="create">
    {{ Form::close() }}
  </div>
</div>

@endsection