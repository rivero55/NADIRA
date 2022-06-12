<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "name",
        "alamat",
        "deskripsi",
        "photo_path",
        "operasional",
        "kontak_rs",
        "kontak_ambulance",
        "lat",
        "long",
        "fasilitas",
        "created_at",
        "updated_at",
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:00',
        'updated_at' => 'datetime:Y-m-d H:00',
    ];

    protected $appends=['real_photo_path'];

    function getRealPhotoPathAttribute(){
        return url('/').$this->photo_path;
    }
}
