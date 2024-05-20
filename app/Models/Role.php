<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
    
    protected $casts = [
      'id' => 'string',
    ];
    protected $keyType='string';
    protected $primaryKey = "id";
   


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
