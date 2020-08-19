<?php

namespace App\Http\Controllers;

use App\Ptm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PtmController extends Controller
{
    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('Parent')) {
            $getdata = Ptm::where('parent_id', '=', $user->id)->get();
        }
        else {
            $getdata = Ptm::get();
        }
            return view('backend.ptm.index',compact('getdata'));
    }

    public function show()
    {
        return view('backend.ptm.create');
    }

    public function ptmaddrequest(Request $request)
    {
        $user=Auth::user();
        echo $user->id;
        $ptm = new Ptm();
        $ptm->create([
            'date' => $request->date,
            'time' => $request->time,
            'parent_id' => $user->id
        ]);
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $user = Ptm::findOrFail($request->id);
        $user->delete();
        return back();
    }

    public function edit($id)
    {

        $ptm = Ptm::where('id', '=', $id)->with('user')->get()->toArray();
        if (isset($ptm[0])) {
            $ptm = $ptm[0];
            return view('backend.ptm.edit', compact('ptm'));
        }
        else {
            redirect()->back();
        }

    }

    public function updateptm(Request $request)
    {

        $id       = $request->id;
        $date     = $request->date;
        $status     = $request->status;
        $time     = $request->time;
        DB::update('update ptms set date = ?,time=?,status=? where id = ?',
            [$time,$date,$status,$id]);
        return redirect('ptm');

    }
}
