<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceWorkUnit extends Model
{    
    use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
    protected $table = 'reference_work_units';
    protected $fillable = [
        'registration_number',
        'address',
        'province',
        'city',
        'district',
        'village',
        'zip_code',
        'status',
        'education_form',
        'ministry',
        'tax_number',
        'establishment_letter_number',
        'establishment_date',
        'operational_letter_number',
        'operational_letter_date',
        'operational_letter_file',
        'accreditation',
        'fax_number',
        'phone_number',
        'email',
        'website',
        'created_by',
        'modified_by'
    ];

    protected $dates = [
        'updated_at',
        'deleted_at'
    ];
}
