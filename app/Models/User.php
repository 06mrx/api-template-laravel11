<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey = "id";
    protected $keyType='string';
    protected $fillable = [
        'name',
        'email',
        'password',
        'personal_data_id',
        'reference_work_unit_id',
        'registration_number',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => "string"
    ];


    function hasRoles($roles) : bool {
        $my_role = $this->role->name;
        if (in_array($my_role, $roles)) return true;
        
        return false;
    }
    

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function referenceWorkUnit()
    {
        return $this->belongsTo(ReferenceWorkUnit::class, 'reference_work_unit_id');
    }

    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'personal_data_id');
    }

    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class, 'user_id');
    }
}
