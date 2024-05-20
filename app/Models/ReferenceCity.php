<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceCity extends Model
{
    use HasFactory;
    protected $table = 'indonesia_cities';

    public function province()
    {
        return $this->belongsTo(ReferenceProvince::class, 'province_code');
    }
}
