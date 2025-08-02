<?php

namespace Modules\BackOffice\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable; // 🔁 Changer de base Model
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use Modules\BackOffice\Entities\UserTypeModels;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Notifications\Notifiable;

class userTmModel extends Authenticatable
{
    use HasFactory,Notifiable, HasApiTokens;

    protected $table = 'userTm';
    protected $primaryKey = 'id';

    protected $fillable = [
        "name", "email", "password", "user_type_id",
        "email_verified_at", "remember_token", "phone_number"
    ];

    protected $hidden = ['password', 'remember_token'];

    public function userType()
    {
        return $this->belongsTo(UserTypeModels::class, 'user_type_id');
    }
}

