<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Verification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vehicle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function verification()
    {
        return $this->hasMany(Verification::class);
    }

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%'.$term.'%';


            $query->where(function ($query) use ($term) {
                $query->where('rego', 'like', $term)
                ->orWhere('make', 'like', $term)
                ->orWhere('model', 'like', $term);
            });
        });
    }
}
