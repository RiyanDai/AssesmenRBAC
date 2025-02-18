<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'manager_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function subordinates()
    {
        return $this->hasMany(User::class, 'manager_id');
    }

    public function hasRole($roleName)
    {
        return $this->role->name === $roleName;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function dailyReports()
    {
        return $this->hasMany(DailyReport::class);
    }
}