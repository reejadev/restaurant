<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\Order;

use App\Models\Reservation;
use App\Models\User;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function user()
    {
        $data=user::all();
        return view('admin.users',compact("data"));
    }

    public function deleteuser($id)
    {
        $data=User::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function foodmenu()
    {
        $data = food::all();
        return view('admin.foodmenu',compact("data"));
    }

    public function adminreservation()
    {
        $data = reservation::all();
        return view('admin.adminreservation',compact("data"));
    }

    public function deletemenu($id)
    {
        $data = food::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function updateview($id)
    {
        $data = food::find($id);
       
        return view("admin.updateview",compact("data"));
    }


    public function update($id, Request $request)
    {
        $data = Food::find($id);
    
        if ($request->file('image')) {
            $ext = $request->file('image')->extension();
            $foodImage = $request->file('image');
            $filename = Str::random(25);
            $path = "$filename.$ext";
            $foodImage->storeAs('public', $path);
    
            // Update fields based on request data
            $data->title = $request->input('title');
            $data->price = $request->input('price');
            $data->description = $request->input('description');
            $data->image = $path;
        }
    
        $data->save();
    
        return redirect()->back();
    }
    

    public function reservation(Request $request)
    {
        $data = new Reservation;
    
            $data->Name = $request->input('name');
            $data->email = $request->input('email');
            $data->phone = $request->input('Phonenumber');
            $data->guest = $request->input('NumberofGuest');
            $data->date = $request->input('Date');
            $data->time = $request->input('Time');
            $data->message = $request->input('message');
           
        
    
        $data->save();
    
        return redirect()->back();
    }
    
    


    public function upload(Request $request)
    {

        if($request->file('image')){
            $ext = $request->file('image')->extension();
            $foodimage = file_get_contents($request->file('image'));
            $filename = Str::random(25);
            $path = "$filename.$ext";
            Storage::disk('public')->put($path, $foodimage);
            
        }


        //$data->image=$imagename;
    $title = $request->input('title');
    $price = $request->input('price');
    $description = $request->input('description');

    Food::create(['title' => $title,
    'price'=> $price,
    'description'=> $description,   
    'image'=>$path
]);

        return redirect()->back();
    }

    public function orders()
     {
        $data=order::all();

        return view('admin.orders',compact('data'));
     }

     public function search(Request $request)
     {
        $search=$request->search;
        $data=order::where('name','Like','%'.$search.'%')->orWhere('foodname','Like','%'.$search.'%')->get();

        return view('admin.orders',compact('data'));
     }
}
