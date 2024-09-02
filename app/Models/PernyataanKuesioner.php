<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PernyataanKuesioner extends Model
{
    protected $table = 'pernyataan_kuesioner';
    protected $guarded = [];
    use HasFactory;

    public function variable()
    {
        return $this->belongsTo(VariableKuesioner::class);
    }
}
