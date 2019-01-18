<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes, NodeTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'template', 'title', 'url', 'meta_keywords', 'meta_description', 'published'
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)->orderBy('sort_order');
    }

    public function activeSections()
    {
        return $this->hasMany(PageSection::class)->where('page_sections.published', '=', 1)->orderBy('sort_order');
    }

    public function getHasSectionsAttribute()
    {
        return $this->sections->count() ? false : true;
    }
}