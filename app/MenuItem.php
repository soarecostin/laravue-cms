<?php

namespace App;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use SoftDeletes;
    use NodeTrait;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'url', 'published', 'parent_id', 'menu_id'
    ];

    public function activeChildren()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')
                    ->where('published', 1);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}