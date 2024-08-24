<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;
    protected $table = 'responses';
    protected $fillable = ['kuesioner_id', 'pernyataan_kuesioner_id', 'value_kuesioner'];
}
