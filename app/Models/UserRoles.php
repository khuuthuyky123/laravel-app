<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRoles extends Model
{
    use HasFactory;
    protected $guard = [
        'id','role'
    ];
    public function user()
    {
        return $this->hasMany(User::class,'role_id','id');
    }
}
