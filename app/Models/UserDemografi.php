<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDemografi extends Model
{
    use HasFactory;
    protected $table = 'user_demografi';
    protected $fillable = ['user_id', 'demografi_id', 'value_answer'];
}
