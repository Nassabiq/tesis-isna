<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VariableKuesioner extends Model
{
    protected $table = 'variable_kuesioner';
    use HasFactory;

    public function pernyataan(): HasMany
    {
        return $this->hasMany(PernyataanKuesioner::class, 'variable_id');
    }
}
