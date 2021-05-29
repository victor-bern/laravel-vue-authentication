<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;


    protected $fillable = ["name", "finished"];


    public function user()
    {
        return $this->hasOne(User::class, "user_id", "id");
    }
}
