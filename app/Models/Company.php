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

    public static function booted()
    {
        /************************
         * When a company is created, an objectable_id needs to be assigned to the objects migration
         * which is linked to a company, this will then create new folder with the company name
         * then access the objectable object and assign a folder to the object
         * and persist to the database
         ***********************/
        static::created(function ($company) {
            $folder = $company->folders()->create(['name' => $company->name]);
            $object = $company->objects()->make(['parent_id' => null]);
            $object->objectable()->associate($folder);
            $object->save();
        });
    }

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
