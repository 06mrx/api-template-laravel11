<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceTransportationType extends Model
{
    use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
    protected $table = 'reference_transportation_types';
    protected $fillable = [
        'name',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'updated_at',
        'deleted_at'
    ];
}
