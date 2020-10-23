<?php

namespace App\Models;

use App\Models\Obj;
use App\Models\File;
use App\Models\User;
use App\Models\Folder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function objects()
    {
        return $this->hasMany(Obj::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function folders()
    {
        return $this->hasMany(Folder::class);
    }
}
