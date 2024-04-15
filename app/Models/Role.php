<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory;

    public const ADMIN = 1;
    public const STAFF = 2;
    public const USER = 3;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}