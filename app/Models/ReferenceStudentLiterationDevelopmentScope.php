<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceStudentLiterationDevelopmentScope extends Model
{
    use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
    protected $fillable = [
        'scope',
        'code',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'updated_at',
        'deleted_at'
    ];

    public function referenceStudentLiterationDevelopmentIndicator()
    {
        return $this->hasOne('App\Models\ReferenceStudentLiterationDevelopmentIndicator', 'reference_student_literation_development_scope_id');
    }
}
