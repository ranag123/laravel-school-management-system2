<?php

namespace App\Http\Controllers;

use App\Assessment;
use App\Grade;
use App\Subject;
use Illuminate\Http\Request;
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

    public function viewassessments($id)
    {
        $asses = Assessment::where('class_id', '=', $id)->with('subjects')->get()->toArray();
        return view('backend.assessment.viewassessments', compact('asses','id'));
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

}
