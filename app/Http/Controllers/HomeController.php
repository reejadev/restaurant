<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id()){

            return redirect('redirects');
        }
        else
        $data=Food::all();
        return view('home',compact('data'));
    }
    
    public function addtocart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user_id=Auth::id();
            $foodid=$id;
            $quantity=$request->quantity;

            $cart=new Cart;

            $cart->user_id=$user_id;
            $cart->food_id= $foodid;
            $cart->quantity= $quantity;
            $cart->save();


            return redirect()->back();
        }
        else{

            return redirect('/login');
        }
    }

    public function redirects()
    {
        if(auth()->check()){
        $data=food::all();
       $usertype= Auth::user()->usertype;

       if($usertype=='1')
       {
        return view('admin.adminhome');

       }

       else
     {
        $user_id = Auth::id();
        $count = Cart::where('user_id', $user_id)->count();

        // $count = $cart ? $cart->sum('quantity') : 0;

        return view('home', compact('data', 'count'));
    }
}else{
    return redirect()->route('login');
}
    }
    

    public function showcart(Request $request,$id)
    {
 $count=Cart::where('user_id',$id)->count();

 if(Auth::id()==$id){
 $data2=cart::select('*')->where('user_id', '=',$id)->get();
 $data =Cart::where('user_id',$id)->join('food', 'carts.food_id', '=','food.id')->get();
        return view('showcart',compact('count','data','data2'));
    }
    }
    
    public function remove($id)
    {
$data=cart::find($id);
$data->delete();
return redirect()->back();
    }

    public function orderconfirm(Request $request)
    {

        foreach($request->foodname as $key => $foodname)
        {
            $data=new order;
            $data->foodname=$foodname;
            $data->price=$request->price[$key];
            $data->quantity=$request->quantity[$key];
            $data->name=$request->name;
            $data->phone=$request->phone;
            $data->address=$request->address;
            $data->save();

        }

        //  return redirect()->route('stripe.stripecheckout');

        // return redirect()->back();

        return redirect()->route('stripe.checkout')->with([
            //'total' => $request->full_total,
            'items' => $request->foodname,
            'prices' => $request->price,
            'quantities' => $request->quantity

            // 'items' => json_encode($request->foodname),
            // 'prices' => json_encode($request->price),
            // 'quantities' => json_encode($request->quantity),
            // 'full_total' => $request->full_total
        ]);
        }


}