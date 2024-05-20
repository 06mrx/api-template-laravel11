<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalData extends Model
{
  use HasFactory, CreatedByAndModifiedBy, SoftDeletes;

  protected $table = 'personal_datas';
  protected $casts = [
    'id' => 'string',
  ];
  protected $keyType='string';
  protected $primaryKey = "id";
  protected $fillable = [
    'name',
    'registration_number',
    'id_number',
    'educator_number',
    'birth_place',
    'gender',
    'reference_marital_status_id',
    'reference_religion_id',
    'reference_rank_id',
    'reference_work_unit_id',
    'reference_position_id',
    'reference_status_id',
    'reference_education_id',
    'tax_number',
    'teacher_type',
    'address',
    'province',
    'city',
    'district',
    'village',
    'zip_code',
    'created_by',
    'modified_by'
  ];

  protected $dates = [
      'birth_date',
      'cs_year',
      'cs_candidate_year',
      'created_at',
      'updated_at',
      'deleted_at'
  ];

  public function getBirthDateAttribute($value)
  {
    return \Carbon\Carbon::parse($value)->locale('id')->format('d F Y');
  }

  public function getCsYearAttribute($value)
  {
    return \Carbon\Carbon::parse($value)->locale('id')->format('d F Y');
  }

  public function getCsCandidateYeareAttribute($value)
  {
    return \Carbon\Carbon::parse($value)->locale('id')->format('d F Y');
  }

  public function referenceMaritalStatus()
  {
    return $this->belongsTo('App\Models\ReferenceMaritalStatus', 'reference_marital_status_id');
  }

  public function referenceReligion()
  {
    return $this->belongsTo('App\Models\ReferenceReligion', 'reference_religion_id');
  }

  public function referenceRank()
  {
    return $this->belongsTo('App\Models\ReferenceRank', 'reference_rank_id');
  }

  public function referenceWorkUnit()
  {
    return $this->belongsTo('App\Models\ReferenceWorkUnit', 'reference_work_unit_id');
  }

  public function referencePosition()
  {
    return $this->belongsTo('App\Models\ReferencePosition', 'reference_position_id');
  }

  public function referenceStatus()
  {
    return $this->belongsTo('App\Models\ReferenceStatus', 'reference_status_id');
  }

  public function referenceEducation()
  {
    return $this->belongsTo('App\Models\ReferenceEducation', 'reference_education_id');
  }
}
