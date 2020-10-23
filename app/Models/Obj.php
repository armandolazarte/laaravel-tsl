<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Obj extends Model
{
    use HasFactory;

    public $table = 'objects';

    public static function booted()
    {
        static::created(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function objectable()
    {
        return $this->morphTo();
    }
}
