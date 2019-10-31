<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    protected $attendance;
    
    public function __construct(Attendance $attendance)
    {
        $this->middleware('auth');
        $this->attendance = $attendance;
    }
    
    /**
     * 勤怠登録画面の表示
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $attendance_data = $request->all();
        $attendances = $this->attendance->all();
        $attendance = $this->attendance->fetchAttendance(Auth::id(), Carbon::now()->format('Y-m-d'));
        return view('user.attendance.index', compact('attendance_data', 'attendances', 'attendance'));
    }
    
    /**
     * 出勤時間をデータベースに格納。
     *
     * @param Request $request
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $attendance = $request->all();
        $attendance['user_id'] = Auth::id();
        $attendance['date'] = Carbon::now();
        $this->attendance->fill($attendance)->save();
        return redirect()->route('attendance.index');
    }
    
    /**
     * 退勤時間をデータベースに格納。
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeEndTime(Request $request, $attendanceId)
    {
        $attendance = $request->all();
        $this->attendance->find($attendanceId)->fill($attendance)->save();
        return redirect()->route('attendance.index');
    }
    
    /**
     * 欠勤情報をデータベースに格納
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeAbsence(Request $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $inputs['date'] = Carbon::now();
        $this->attendance->fill($inputs)->save();
        return redirect()->route('attendance.index');
    }
    
    /**
     * 修正申請情報をデータベースに格納。
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeModification(Request $request)
    {
        $inputs = $request->all();
        $inputs['user_id'] = Auth::id();
        $attendances = $this->attendance->where('user_id', Auth::id())->where('date', $inputs['date'])->get();
        foreach ($attendances as $attendance)
        {
            $attendance->fill($inputs)->save();
        }
        return redirect()->route('attendance.index');
    }
    
    /**
     * 欠席登録画面の表示。
     *
     * @return \Illuminate\Http\Response
     */
    public function registerAbsence()
    {
        return view('user.attendance.absence');
    } 
    
    /**
     * 修正申請画面の表示。
     *
     * @return \Illuminate\Http\Response
     */
    public function reportModification()
    {
        return view('user.attendance.modify');
    }
    
    /**
     * マイページの表示。
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function showMyPage($userId)
    {
        $attendances = $this->attendance->getMyAttendancesByUserId($userId);
        $sumDate = $this->attendance->where('user_id', $userId)->whereNotNull('start_time')->whereNotNull('end_time')->count();
        $attendancesTime = $this->attendance->where('user_id', $userId)->whereNotNull('start_time')->whereNotNull('end_time')->get();
        $totalTime = 0;
        foreach ($attendancesTime as $attendanceTime)
        {
            $timeMinutes = $attendanceTime->start_time->diffInMinutes($attendanceTime->end_time);
            $totalTime += $timeMinutes;
        }
        $sumTime = round($totalTime/60);
        return view('user.attendance.mypage', compact('attendances', 'sumDate', 'sumTime'));
    }
}
