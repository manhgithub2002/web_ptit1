<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory;
//    use SoftDeletes;
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function getGenderNameAttribute()
    {
        return ($this->gender == 0 ? 'Female' : 'Male');
    }
}
