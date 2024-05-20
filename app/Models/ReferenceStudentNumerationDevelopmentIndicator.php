<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceStudentNumerationDevelopmentIndicator extends Model
{
    use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
    protected $fillable = [
        'reference_student_numeration_development_scope_id',
        'achievement',
        'code',
        'start_age_group',
        'end_age_group',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'updated_at',
        'deleted_at'
    ];

    public function referenceStudentNumerationDevelopmentScope()
    {
        return $this->belongsTo('App\Models\ReferenceStudentNumerationDevelopmentScope', 'reference_student_numeration_development_scope_id');
    }
}
