<?php

use App\Models\User;
use App\Models\UserRequest;

function getConnectionCount(){
    return auth()->user()->userConnections->count();
}

function getRequestSentCount(){
    return auth()->user()->userRequests->count();
}

function getRequestRecievedCount(){
    return UserRequest::where('requested_user_id',auth()->user()->id)->get()->count();
}

function getSuggestionCount(){
    $userConnections = auth()->user()->userConnections->pluck('connected_user_id');
        $userRequests = auth()->user()->userRequests->pluck('requested_user_id');
        $userIds = $userConnections->merge($userRequests)->unique();
        $suggestions = User::whereNotIn('id',$userIds)->get();
        return $suggestions->count();
}
