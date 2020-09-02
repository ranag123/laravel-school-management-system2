<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Parents;
use App\Student;
use App\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VoucherController extends Controller
{
    public function index(){
        $student=array();
        $user = Auth::user();
        if ($user->hasRole('Student') ) {
            $student = Voucher::with('class')->with('user')->with('students')->where('user_id','=',$user->id)->get();
        }
        elseif( $user->hasRole('Parent'))
        {
            $id=$user->id;
            $a=Parents::where('user_id','=',$user->id)->get()->toArray();
            if(isset($a[0])){
               $parent_id=$a[0]['id'];
            $student = Voucher::with('class')->with('user')->with('students')
                ->whereHas('students', function($q) use($parent_id){
                    $q->where('students.parent_id','=',$parent_id);
                })->get();
            }
        }
        else{
            $student = Voucher::with('class')->with('user')->with('students')->get();
        }
         return view('backend.voucher.index',compact('student'));
    }
    public function create()
    {
        $class = Grade::latest()->get()->toArray();
        return view('backend.voucher.create',compact('class'));
    }
    public function getstudent(Request $request)
    {
        $student = Student::with('user')->where('class_id','=',$request['id'])->get()->toArray();
        echo json_encode($student);
    }
    public function voucheraddrequest(Request $request)
    {
        $user=new Voucher();
        $user->create([
            'class_id'         => $request->class_id,
            'student_id'          => $request->student_id,
            'user_id'          => $request->user_id,
            'date'             => $request->date,
            'amount'       => $request->amount,
//             'payment' => $request->payment,
            'method' => $request->methods,
            'status' => $request->status
        ]);
        return redirect('voucher');
    }
    public function view($id)
    {
        $student = Voucher::with('class')->with('user')->with('students')->where('id','=',$id)->get();
        return view('backend.voucher.view',compact('student'));
    }
    public function destroy(Request $request)
    {
        $user = Voucher::findOrFail($request->id);
        $user->delete();
          return back();
    }
    public function edit($id)
    {
        $class = Grade::latest()->get()->toArray();
        $student = Voucher::with('class')->with('user')->with('students')->where('id', '=', $id)->get();
        if (isset($student[0])) {
            $student=$student[0];
            return view('backend.voucher.edit', compact('student', 'class'));
        }else{
            return back();
        }
    }
    public function voucherupdaterequest(Request $request)
    {
            $user_id         =$request->user_id;
            $class_id         = $request->class_id;
             $student_id         =$request->student_id;
             $date        = $request->date;
            $amount         = $request->amount;
//            $payment         = $request->payment;
             $method         = $request->methods;
            $id         = $request->id;
            $status         = $request->status;

        DB::update('update vouchers set user_id = ?,class_id=?,student_id=?,status=?
 ,date=?,amount=?,method=? where id = ?',
            [$user_id,$class_id,$student_id,$status,$date,$amount,$method,$id]);
        return redirect('voucher');
        }




}
