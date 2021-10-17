<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class AnimeFilter extends QueryFilter
{
    public function search(string $value) {
        return $this->builder->where('title', 'LIKE', "%{$value}%");
    }

    public function categories($categories) {
        return $this->builder->whereHas("categories", fn($q) => 
                $q->whereIn("categories.name", $categories)
            )->get();
    }

    public function studios($studios) {
        return $this->builder->whereHas("studio", fn($q) => 
                $q->whereIn("studios.name", $studios)
            )->get();
    }
    
    public function years($years) {
        return $this->builder->whereIn("year",$years);
    }
}