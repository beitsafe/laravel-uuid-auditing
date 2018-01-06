<?php

namespace BeITSafe\Laravel\Traits;

use Illuminate\Support\Facades\Schema;

/**
 * Trait Uuids
 * @package App
 */
trait Auditing
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function bootAuditing()
    {
        /**
         * Attach to the 'creating' Model Event to provide a user id
         * for the `created_at` field (if logged in)
         */
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'created_by')) {
                if (@\Auth::user()) {
                    $model->created_by = \Auth::user()->id;
                }
            }
        });

        /**
         * Attach to the 'updating' Model Event to provide a user id
         * for the `updated_at` field (if logged in)
         */
        static::updating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                if (@\Auth::user()) {
                    $model->updated_by = \Auth::user()->id;
                }
            }
        });

        /**
         * Attach to the 'deleting' Model Event to provide a user id
         * for the `deleted_at` field (if logged in)
         */
        static::deleting(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'deleted_by')) {
                if (@\Auth::user()) {
                    $model->deleted_by = \Auth::user()->id;
                    $model->save();
                }
            }
        });
    }
}