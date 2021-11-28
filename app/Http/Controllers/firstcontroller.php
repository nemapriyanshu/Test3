<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Firstmodel;

class firstcontroller extends Controller
{
    //----------------------SHOW DATA-----------------------
    public function index()
    {
        $data=DB::table("firstmodels")->get();
    
        return view('show',compact('data'));
    }

    
    public function create()
    {
        return view("add");
    }

//-------------------ADD DONNE-------------------------
    public function store(Request $req)
    {
       
        //| unique:connection.firstmodels,email
        $answers=$req->validate([
            'firstname'=>'required | min:3 | max:30',
            'lastname'=>'required | min:3 | max:30',
            'email'=>'required|unique:firstmodels,email|regex:/^[a-zA-Z0-9+_.-]+@[a-zA-Z0-9.-]+$/',

            'mobile'=> 'required|unique:firstmodels,mobile|regex:/^([+]\d{2}[ ])?\d{10}$/',

            'city'=>'required | min:5 | max:25',
            'gender'=>'required',
            'age'=>'required | min:5 | max:100 | integer | between:1,100',
            'photo'=>'required | mimes:jpeg,jpg,png | max:10000  ',
        ],
    [
        'email.regex' => 'Enter Email in valid Formate @ ',
        'age.between' => 'age not greater than 100'

    ]);

        if($answers)
        {
            $filename = "Image-".time().".".$req->photo->extension();
            move_uploaded_file($req->photo,"uploads/$filename");

           $kk= DB::table("firstmodels")->insert([
                'firstname'=> $req->firstname,
                'lastname'=> $req->lastname,
                'email'=> $req->email,
                'city'=> $req->city,
                'gender'=> $req->gender,
                'age'=> $req->age,
                'mobile'=> $req->mobile,
                'status'=> $req->status,
                'image'=> $filename
                
            ]);

              return redirect("show");
            
        }
       

    }




    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data=DB::table("firstmodels")->where('id',$id)->first();
     
        return view('edit',compact('data'));
    }

   
    public function update(Request $req, $id)
    {
        DB::table("firstmodels")->where('id',$id)->update([
            'firstname'=> $req->firstname,
            'lastname'=> $req->lastname,
            'email'=> $req->email,
            'city'=> $req->city,
            'gender'=> $req->gender,
            'age'=> $req->age,
            'mobile'=> $req->mobile,
            'status'=> $req->status
            
        ]);

          return redirect("show");
    }

    public function destroy($id)
    {
        DB::table("firstmodels")->where('id',$id)->delete();
        return redirect("show");
    }
}
