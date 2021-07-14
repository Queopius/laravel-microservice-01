<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getCompanies(string $filter)
    {
        $companies = $this->with('category')
                        ->where(function($query) use ($filter) {
                            if($filter != '') {
                                $query->where('name', 'LIKE', "%{$filter}%");
                                $query->orWhere('email', '=', $filter);
                                $query->orWhere('phone', '=', $filter);
                            }
                        })
                        ->paginate();
        return $companies;
    }
}
