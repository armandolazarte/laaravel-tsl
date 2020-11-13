<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%'.$term.'%';


            $query->where(function ($query) use ($term) {
                $query->where('company_name', 'like', $term)
                ->orWhere('account_number', 'like', $term)
                ->orWhere('email', 'like', $term)
                ->orWhere('contact_name', 'like', $term)
                ->orWhere('street_address', 'like', $term);
            });
        });
    }
}
