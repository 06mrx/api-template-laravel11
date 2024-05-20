<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Lib\Traits\CreatedByAndModifiedBy;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceGirlHeightStandart extends Model
{
  use HasFactory, CreatedByAndModifiedBy, SoftDeletes;
  protected $table = 'reference_girl_height_standarts';
  protected $fillable = [
    'age',
    'minus_3_sd',
    'minus_2_sd',
    'minus_1_sd',
    'median',
    'plus_1_sd',
    'plus_2_sd',
    'plus_3_sd',
    'created_by',
    'modified_by'
  ];

  protected $dates = [
    'updated_at',
    'deleted_at'
  ];
}
