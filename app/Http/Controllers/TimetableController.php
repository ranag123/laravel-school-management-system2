<?php

namespace App\Http\Controllers;

use App\Grade;
use App\User;
use App\Subject;
use App\Teacher;
use App\Timetable;
use Cassandra\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TimetableController extends Controller
{
    public function index()
    {
        $class=array();
        $user = Auth::user();
          if($user->hasRole('Student'))
        {
            $class = Grade::latest()->get()->where('id','=',$user->student->class_id);
        }
          elseif($user->hasRole('Teacher'))
          {
              $class = Grade::latest()->get()->where('teacher_id','=',$user->teacher->id);
          }
        else {
            $class = Grade::latest()->get();
             }
        return view('backend.timetable.index',compact('class'));
    }
    public function create()
    {
        $class = Grade::latest()->get()->toArray();
        $subject = Subject::latest()->get()->toArray();
        return view('backend.timetable.create',compact('class','subject'));
    }
    public function timetableaddrequest(Request $request)
    {
        $i = 1;
        $user = new Timetable();
        $time = Timetable::latest()->get()->toArray();
         foreach ($time as $key => $value) {
            if ($value['start_time'] >= $request->start_time && $value['end_time'] <= $request->end_time
                && $value['date'] == $request->date && $value['teacher_id'] == $request->teacher_id) {
                 $i = 0;
            }
        }
          if ($i == 0) {
           echo 'Time Overlapping' ;
        } else {

            $user->create([
                'class_id' => $request->class_id,
                'subject_id' => $request->subject_id,
                'teacher_id' => $request->teacher_id,
                'date' => $request->date,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time
            ]);
           echo "success";
        }
    }
    public function getteacher(Request $request)
    {
        $student = Teacher::with('user')
            ->where('id','=',$request['id'])->get()->toArray();
        echo json_encode($student);
    }
    public function destroy(Request $request)
    {
        $user = Timetable::findOrFail($request->id);
        $user->delete();
        return back();
    }
    public function view($id)
    {
        $user = Auth::user();
        if($user->hasRole('Teacher')) {
            $student = Timetable::with('class')->with('teacher')->with('subjects')->where('class_id', '=', $id)
                ->where('teacher_id','=',$user->teacher->id)
                ->get();
        }
        else{
            $student = Timetable::with('class')->with('teacher')->with('subjects')->where('class_id', '=', $id)
                ->get();
        }
         $users = User::all();
         return view('backend.timetable.view', compact('student','users'));
    }
    public function edit($id)
    {
        $class = Grade::latest()->get()->toArray();
        $subject = Subject::latest()->get()->toArray();
        $timetable = Timetable::with('teacher')->where('id','=',$id)->get();
        $users = User::all();
        if(isset($timetable[0]))
        {
            $timetable=$timetable[0];
            return view('backend.timetable.edit', compact('subject', 'class','timetable','users'));
        }
        else{
            return back();
        }

    }
    public function timetableupdaterequest(Request $request)
    {
        $class_id         = $request->class_id;
        $subject_id         =$request->subject_id;
        $date        = $request->date;
        $start_time        = $request->start_time;
        $end_time         = $request->end_time;
        $id         = $request->id;
        DB::update('update timetables set  class_id=?,subject_id=?
            ,date=?,start_time=?,end_time=? where id = ?',
            [$class_id,$subject_id,$date,$start_time,$end_time,$id]);
        return back();
    }
}
