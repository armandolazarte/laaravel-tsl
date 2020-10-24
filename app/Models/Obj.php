<?php

namespace App\Models;

use App\Models\Obj;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Staudenmeir\LaravelAdjacencyList\Eloquent\HasRecursiveRelationships;

class Obj extends Model
{
    use HasFactory, HasRecursiveRelationships;

    public $table = 'objects';

    protected $guarded = [];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function scopeForCurrentCompany($query)
    {
        $query->where('company_id', auth()->user()->company->id);
    }

    public function objectable()
    {
        return $this->morphTo();
    }

    
}
