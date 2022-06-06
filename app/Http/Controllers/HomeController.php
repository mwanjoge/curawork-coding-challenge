<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
        return view('home');
    }

    public function suggestions(Request $request){
        $userConnections = auth()->user()->userConnections->pluck('connected_user_id');
        $userRequests = auth()->user()->userRequests->pluck('requested_user_id');
        $userIds = $userConnections->merge($userRequests)->unique();
        $suggestions = User::whereNotIn('id',$userIds)->limit($request->pageCount)->get();

        return view('components.suggestion',compact('suggestions'));

    }

    public function getLoader(){
        return view('components.skeleton');
    }
}
