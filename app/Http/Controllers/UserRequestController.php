<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequestRequest;
use App\Http\Requests\UpdateUserRequestRequest;
use App\Models\User;
use App\Models\UserConnection;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($mode,Request $request)
    {
        $userRequests = auth()->user()->userRequests;
        if($mode === 'sent'){
            $userRequests = UserRequest::where('user_id',auth()->user()->id)
            ->limit($request->pageCount)->get();
        }
        else{
            $userRequests = UserRequest::where('requested_user_id',auth()->user()->id)
            ->limit($request->pageCount)->get();
        }

        return view('components.request', compact('userRequests','mode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequestRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $user = User::find(auth()->user()->id);
        $suggested = User::find($id);

        $connection = new UserRequest(['requested_user_id' => $suggested->id]);
        $user->userRequests()->save($connection);
        return response()->json($connection,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function show(UserRequest $userRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(UserRequest $userRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequestRequest  $request
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequestRequest $request, UserRequest $userRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserRequest  $userRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userRequest = UserRequest::find($id);
        $userRequest->delete();
        $userRequests = UserRequest::where('user_id',auth()->user()->id)
            ->limit(10)->get();
            $mode = "sent";
        return view('components.request', compact('userRequests','mode'));
    }
}
