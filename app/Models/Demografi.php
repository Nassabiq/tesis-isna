<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Demografi extends Model
{
    protected $table = 'demografi';
    protected $fillable = ['question', 'slug_question', 'answer', 'form_type', 'is_positive'];
    use HasFactory;

    public function userDemografi(): HasMany
    {
        return $this->hasMany(UserDemografi::class, 'demografi_id', 'id');
    }
}
