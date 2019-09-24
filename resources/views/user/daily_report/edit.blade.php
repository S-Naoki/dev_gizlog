@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['report.update', $dailyReport->id],  'method' => 'PUT']) !!}
      <div class="form-group form-size-small @if($errors->has('reporting_time')) has-error @endif ">
        {!! Form::date('reporting_time', $dailyReport->reporting_time->format('Y-m-d'), ['class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('reporting_time') }}</span>
      </div>
      <div class="form-group @if($errors->has('title')) has-error @endif ">
        {!! Form::text('title', $dailyReport->title, ['class' => 'form-control', 'placeholder' => 'Title'])!!}
      <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group @if($errors->has('content')) has-error @endif ">
        {!! Form::textarea('content', '本文', ['class' => 'form-control', 'placeholder' => '本文']) !!}
      <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    {{ Form::close() }}
  </div>
</div>

@endsection