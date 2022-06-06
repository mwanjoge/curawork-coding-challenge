<?php

namespace App\Http\Controllers;

use App\Models\UserConnection;
use Illuminate\Http\Request;

class UserConnectionController extends Controller
{
    public function index(Request $request){
        $connections = UserConnection::where('user_id',auth()->user()->id)
        ->limit($request->pageCount)->get();
        return view('components.connection',compact('connections'));
    }
}
