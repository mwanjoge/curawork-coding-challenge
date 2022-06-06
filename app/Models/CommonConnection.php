<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonConnection extends Model
{
    use HasFactory;

    protected $fillable = ['connected_user_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
