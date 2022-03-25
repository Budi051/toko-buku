<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//$this->authorize('checkmember');
        $user = Auth::user();
        $id = $user->id;
        //$transaction = Order::find($id);
        $transaction = DB::select(DB::raw("SELECT * from orders where user_id = $id"));
        return view('home', compact('transaction'));
    }
}
