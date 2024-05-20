<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferenceDistrict extends Model
{
    use HasFactory;
    protected $table = 'indonesia_districts';

    public function city()
    {
        return $this->belongsTo(ReferenceCity::class, 'city_Code');
    }

    
}
