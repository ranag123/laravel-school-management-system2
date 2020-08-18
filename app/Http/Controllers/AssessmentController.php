<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Grade;
use App\Mark;
use App\Student;
use App\Subject;
use App\User;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    public function index()
    {
        $classes = Grade::latest()->orderBy('id', 'ASC')->get();
        return view('backend.assessment.index', compact('classes'));
    }

    public function create($id)
    {
        $id = $id;
        $class = Grade::latest()->get()->toArray();
        $subject = Subject::latest()->get()->toArray();
        return view('backend.assessment.create', compact('class', 'subject', 'id'));
    }
    public function marks($id)
    {
        $user=Auth::user();
        if($user->hasRole('Student'))
        {
         $asses = Mark::where('assessment_id', '=', $id)->where('student_id','=',$user->id)->with('User')->get()->toArray();
        }
        else{
            $asses = Mark::where('assessment_id', '=', $id)->with('User')->get()->toArray();
        }
         return view('backend.assessment.assignmarks',compact('id','asses'));
    }
    public function marksassign($id)
    {
         $asses = Assessment::where('id', '=', $id)->with('subjects')->with('class')->get()->toArray();
        if(isset($asses[0])) {
            $asses=$asses[0];
            $students = Student::where('class_id', '=', $asses['class']['id'])->with('user')->latest()->get()->toArray();
        }
        return view('backend.assessment.marksassign',compact('asses','students','id'));
    }

    public function updatemarks($id)
    {
        $asses = Mark::where('id', '=', $id)->with('user')->with('assessment')->get()->toArray();
        return view('backend.assessment.updatemarks',compact('asses'));
    }
    public function updatemarksrequest(Request $request)
    {
        $id = $request->id;
        $i = $request->assessment_id;
         $obt_marks = $request->obt_marks;
        DB::update('update marks set obt_marks = ? where id = ?',
            [$obt_marks, $id]);
        return  redirect('assessment/marks/'.$i);
    }
    public function addmarks(Request $request)
    {
        $assess = new Mark();
        $assess->create([
            'student_id' => $request->student_id,
            'assessment_id' => $request->assessment_id,
            'obt_marks' => $request->obt_marks
        ]);
    }

    public function addassessmentrequest(Request $request)
    {
        $assess = new Assessment();
        $assess->create([
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'date' => $request->date,
            'name' => $request->name,
            'total' => $request->total
        ]);
    }
    public function viewassessments($id=0)
    {
        $user=Auth::user();
        if($user->hasRole('Teacher'))
        {
            $asses = Assessment::where('class_id', '=', $id)->with('subjects')->get()->toArray();
            $a=$asses;
            $asses=array();
            foreach ($a as $key=>$value)
            {
                if($value['subjects']['teacher_id']==$user->id)
                {
                    $asses[]=$value;
                }
            }
            return view('backend.assessment.viewassessments', compact('asses','id'));
        }
        elseif($user->hasRole('Student'))
        {
            $asses = array();
            $getuserinfo=Student::where('user_id', '=', $user->id)->get()->toArray();
            if(isset($getuserinfo[0])) {
                $asses = Assessment::where('class_id', '=', $getuserinfo[0]['class_id'])->with('subjects')->get()->toArray();
            }
            return view('backend.assessment.viewassessments', compact('asses','id'));
        }
        else
        {
            $asses = Assessment::where('class_id', '=', $id)->with('subjects')->get()->toArray();
            return view('backend.assessment.viewassessments', compact('asses','id'));
        }

    }

    public function assessmentedit($id)
    {
        $asses = Assessment::where('id', '=', $id)->with('class')->get()->toArray();
        if (isset($asses[0])) {
            $assess = $asses[0];
            $subject = Subject::latest()->get()->toArray();
            return view('backend.assessment.assess_edit', compact('assess', 'subject'));
        } else {
            redirect()->back();
        }
    }

    public function updateassessment(Request $request)
    {
        $class_id = $request->class_id;
        $subject_id = $request->subject_id;
        $date = $request->date;
        $name = $request->name;
        $total = $request->total;
        $id = $request->id;
        DB::update('update assessments set class_id = ?,subject_id=?,date=?
             ,name=?,total=? where id = ?',
            [$class_id, $subject_id, $date, $name, $total, $id]);
     }
     public function assessmentdelete(Request $request)
     {
         $user = Assessment::findOrFail($request->id);
         $user->delete();
         return back();
     }
     public function deletemarks(Request $request)
     {
         $user = Mark::findOrFail($request->id);
         $user->delete();
         return back();
     }
     public function report($id=0)
     {
         $teacher=array();
         $user=Auth::user();
         if($user->hasRole('Student'))
         {
           $students = Student::where('user_id', '=', $user->id)->with('user')->latest()->get()->toArray();
          }
         else {
         $students = Student::where('id', '=', $id)->with('user')->latest()->get()->toArray();
         }
         $subject = Subject::latest()->get()->toArray();
           $asses = Assessment::with('marks')->with('class')->get()->toArray();
           $grade = Grade::with('teacher')->where('id','=',$students[0]['class_id'])->limit(1)->get()->toArray();
          if(isset($grade[0])) {
              $teacher = User::where('id', '=', $grade[0]['teacher']['user_id'])->get()->toArray();
              $teacher = $teacher[0];
          }
         $sum = $totalsum = 0;
          $a=array();
           $i=0;

          foreach ($asses as $key=>$value) {
                foreach ($value['marks'] as $key1 => $value1) {
                     if ($value1['student_id'] == $students[0]['user']['id']) {
                         $value1['total']=$value['total'];
                         $value1['name']=$value['name'];
                         $value1['studentname']=$students[0]['user']['name'];
                         $value1['subject_id']=$value['subject_id'];
                         $value1['class_name']=$value['class']['class_name'];
                         $value1['class_numeric']=$value['class']['class_numeric'];
                           $a[] = $value1 ;
                     }
                 $i++;
             }
          }
            return view('backend.assessment.reportcard',compact('a','subject','teacher'));
     }



}
