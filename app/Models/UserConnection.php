<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserConnection extends Model
{
    use HasFactory;

    protected $fillable = ['connected_user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getConnectedUser(){
        return User::find($this->connected_user_id);
    }
}
