@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {!! Form::open(['route' => 'report.index', 'method' => 'GET']) !!}
      {!! Form::input('month', 'search_month', null, ['class' => 'form-control']) !!}
      {!! Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-icon', 'type' => 'submit']) !!}
      <a class="btn btn-icon" href="{{ route('report.create') }}"><i class="fa fa-plus"></i></a>
    {!! Form::close() !!}
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($dailyReports as $dailyReport)
          <tr class="row">
            <td class="col-xs-2">{{ $dailyReport->reporting_time->format('m/d (D)') }}</td>
            <td class="col-xs-3">{{ Str::limit($dailyReport->title, 30) }}</td>
            <td class="col-xs-5">{{ Str::limit($dailyReport->content, 50) }}</td>
            <td class="col-xs-2"><a class="btn" href="{{ route('report.show', $dailyReport->id) }}"><i class="fa fa-book"></i></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection