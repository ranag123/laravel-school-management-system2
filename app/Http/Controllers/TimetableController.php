<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Parents;
use App\Student;
use App\User;
use App\Subject;
use App\Teacher;
use App\Timetable;
use App\Voucher;
use Carbon\Carbon;
 use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class TimetableController extends Controller
{
    public function index()
    {
        $class = Grade::latest()->get();
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
        echo "<pre>";
        print_r($_POST);
        $user=new Timetable();
        $user->create([
            'class_id'         => $request->class_id,
            'subject_id'          => $request->subject_id,
            'teacher_id'          => $request->teacher_id,
            'date'             => $request->date,
            'start_time'       => $request->start_time,
            'end_time' => $request->end_time
        ]);

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
         $student = Timetable::with('class')->with('teacher')->with('subjects')->where('class_id', '=', $id)
              ->get() ;
        $users = User::all();
         return view('backend.timetable.view', compact('student','users'   ));
    }
    public function edit($id)
    {
        $class = Grade::latest()->get()->toArray();
        $subject = Subject::latest()->get()->toArray();
    }

}
