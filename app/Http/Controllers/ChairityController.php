<?php

namespace App\Http\Controllers;

use App\Chairity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChairityController extends Controller
{
    public function index()
    {
        $chairity=array();
        $chairity = Chairity::get()->toArray();
        return view('backend.chairity.index',compact('chairity'));
    }
    public function create()
    {
        return view('backend.chairity.create');
    }
    public function chairityaddrequest(Request $request)
    {
        $user=new Chairity();
        $user->create([
            'name' => $request->name,
            'amount' => $request->amount
        ]);
        return redirect('chairity/index');
    }


    public function destroy(Request $request)
    {
        $user = Chairity::findOrFail($request->id);
        $user->delete();
        return back();
    }

    public function edit($id)
    {
         $chairity = Chairity::where('id', '=', $id)->get();
        if (isset($chairity[0])) {
            $chairity=$chairity[0];
            return view('backend.chairity.edit', compact('chairity'));
        }else{
            return back();
        }
    }

    public function chairityupdaterequest(Request $request)
    {
        $name   =$request->name;
        $amount  = $request->amount;
        $id  = $request->id;

        DB::update('update chairities set name = ?,amount=? where id = ?',
            [$name,$amount,$id]);
        return redirect('chairity');
    }


}
