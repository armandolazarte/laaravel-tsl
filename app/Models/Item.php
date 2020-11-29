<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%'.$term.'%';

            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term)
                ->orWhere('unit', 'like', $term)
                ->orWhere('description', 'like', $term);
            });
        });
    }
}
