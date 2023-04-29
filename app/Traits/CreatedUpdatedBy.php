<?php

namespace App\Traits;

trait CreatedUpdatedBy
{
    public static function bootCreatedUpdatedBy()
    {
        if (auth()->user()) {
            static::creating(function ($model) {
                if (!$model->isDirty('created_by_id')) {
                    $model->created_by_id = auth()->user()->id;
                }
            });
    
            static::updating(function ($model) {
                if (!$model->isDirty('updated_by_id')) {
                    $model->updated_by_id = auth()->user()->id;
                }
            });
    
            static::deleting(function ($model) {
                if (!$model->isDirty('updated_by_id')) {
                    $model->updated_by_id = auth()->user()->id;
                    $model->save();
                }
            });
        }
    }
}
