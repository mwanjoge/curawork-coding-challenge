<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{
    use HasFactory;

    protected $fillable = ['requested_user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getRequestedUser(){
        return User::find($this->requested_user_id);
    }
}
