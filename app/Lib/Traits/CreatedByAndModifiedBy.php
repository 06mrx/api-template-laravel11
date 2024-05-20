<?php
declare (strict_types = 1);
namespace App\Lib\Traits;

use Illuminate\Support\Facades\Auth;

trait CreatedByAndModifiedBy
{
    /**
     * Boot the Uuid trait for the model.
     *
     * @return void
     */
    public static function bootCreatedByAndModifiedBy(): void
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $model->created_by = Auth::user()->id;
                $model->modified_by = Auth::user()->id;
            }
        });

        static::updating(function ($model) {
            if (Auth::check()) {
                $model->modified_by = Auth::user()->id;
            }
        });

        static::deleting(function ($model) {
            if (Auth::check()) {
                $model->modified_by = Auth::user()->id;
            }
        });
    }
}
