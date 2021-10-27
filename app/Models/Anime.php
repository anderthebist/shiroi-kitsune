<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Filters\QueryFilter;
use App\Scopes\LicenseScope;

class Anime extends Model
{
    protected $table = 'anime';
    protected $guarded = [];

    public function videos() {
        return $this->hasMany('App\Models\Videos')->orderBy('created_at');
    }
    public function categories() {
        return $this->belongsToMany(
            Category::class,
            'categories_animes',
            'anime_id',
            'category_id');
    }
    public function voices() {
        return $this->belongsToMany(
            Voice::class,
            'voices_animes',
            'anime_id',
            'voice_id');
    }
    
    public function comments() {
        return $this->hasMany('App\Models\Coment')->orderBy('created_at', 'desc');
    }
    
    public function studio() {
        return $this->belongsTo('App\Models\Studio')->orderBy('created_at','desc');
    }

    public function scopeFilter(Builder $builder, QueryFilter $filter)
    {
        $filter->apply($builder);
    }

    protected static function booted()
    {
        static::addGlobalScope(new LicenseScope);
    }
}
