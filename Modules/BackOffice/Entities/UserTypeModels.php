<?php

namespace Modules\BackOffice\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class userTypeModels extends Model
{
    use HasFactory, HasApiTokens;

    protected $table = 'userType';
    protected $fillable = ["name", "description", "is_active"];

    protected static function newFactory()
    {
        return \Modules\BackOffice\Database\factories\UserTypeModelsFactory::new();
    }
}
