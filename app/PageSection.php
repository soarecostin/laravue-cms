<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class PageSection extends Model
{
    use SoftDeletes;
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public static function nextSortIndex($pageId)
    {
        $nextSortOrder = 1;
        $maxSortOrder = self::where('page_id', $pageId)->max('sort_order');
        if ($maxSortOrder) {
            $nextSortOrder = $maxSortOrder + 1;
        }
        return $nextSortOrder;
    }
}