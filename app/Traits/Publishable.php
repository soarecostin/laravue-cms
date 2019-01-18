<?php

namespace App\Traits;

trait Publishable
{
    protected $publishedField = 'published';
    
    public function on($entity)
    {
        $success = $entity->update([$this->publishedField => 1]);
        
        return response()->json([
            'ok' => $success
        ]);
    }

    public function off($entity)
    {
        $success = $entity->update([$this->publishedField => 0]);
        
        return response()->json([
            'ok' => $success
        ]);
    }
}
