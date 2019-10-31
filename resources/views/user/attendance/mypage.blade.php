@extends ('common.user')
@section ('content')

<h2 class="brand-header">マイページ</h2>

<div class="main-wrap">
  <div class="btn-wrapper">
    <div class="my-info day-info">
      <p>学習経過日数</p>
      <div class="study-hour-box clearfix">
      @foreach ($attendances as $attendance)
        <div class="userinfo-box"><img src="{{ $attendance->user->avatar }}"></div>
        <p class="study-hour"><span>{{ $sumDate }}</span>日</p>
      @endforeach
      </div>
    </div>
    <div class="my-info">
      <p>累計学習時間</p>
      <div class="study-hour-box clearfix">
        @foreach ($attendances as $attendance)
        <div class="userinfo-box"><img src="{{ $attendance->user->avatar }}"></div>
        <p class="study-hour"><span>{{ $sumTime }}</span>時間</p>
        @endforeach
      </div>
    </div>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table">
      <thead>
        <tr class="row">
          <th class="col-xs-2">date</th>
          <th class="col-xs-3">start time</th>
          <th class="col-xs-3">end time</th>
          <th class="col-xs-2">state</th>
          <th class="col-xs-2">request</th>
        </tr>
      </thead>
      <tbody>
      @foreach($attendances as $attendance)
        <tr class="row @if(is_null($attendance->start_time) && is_null($attendance->end_time)) absent-row @endif">
          <td class="col-xs-2">{{ $attendance->date->format('m/d(D)') }}</td>
          <td class="col-xs-3">@if(!empty($attendance->start_time)) {{ $attendance->start_time->format('H:i') }} @else - @endif</td>
          <td class="col-xs-3">@if(!empty($attendance->end_time)) {{ $attendance->end_time->format('H:i') }} @else - @endif</td>
          <td class="col-xs-2">@if($attendance->absence_state == 1) 欠席 @elseif(is_null($attendance->end_time)) 研修中 @elseif($attendance->absence_state == 0) 出社 @endif</td>
          <td class="col-xs-2">{{ $attendance->request_state == 0 ? '-' : '申請中'}}</td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

