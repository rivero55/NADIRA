<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class People extends Authenticatable
{
    use HasFactory;

    protected $table = "people";
    protected $fillable = [
        "id",
        "nama",
        "nik",
        "username",
        "email",
        "password",
        "jk",
        "no_telp",
        "photo_path",
    ];


    protected $appends = ['random_time'];

    function getRandomTimeAttribute(){
        return time();
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];
}
