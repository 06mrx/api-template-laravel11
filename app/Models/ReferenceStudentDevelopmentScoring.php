<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceStudentDevelopmentScoring extends Model
{
    use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
    protected $fillable = [
        'name',
        'point',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'updated_at',
        'deleted_at'
    ];
}
