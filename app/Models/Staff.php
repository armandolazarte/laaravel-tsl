<?php

namespace App\Models;

use App\Models\Timesheet;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function scopeSearch($query, string $terms = null)
    {
        collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
            $term = '%'.$term.'%';


            $query->where(function ($query) use ($term) {
                $query->where('name', 'like', $term)
                ->orWhere('contact_name', 'like', $term)
                ->orWhere('address', 'like', $term);
            });
        });
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class);
    }

    public function nok()
    {
        return $this->hasMany(Nok::class);
    }
}
