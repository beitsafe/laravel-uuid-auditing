<?php

namespace BeITSafe\Laravel\Traits;

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
            if (@\Auth::user()) {
                $model->created_at = \Auth::user()->id;
            }
        });

        /**
         * Attach to the 'updating' Model Event to provide a user id
         * for the `updated_at` field (if logged in)
         */
        static::updating(function ($model) {
            if (@\Auth::user()) {
                $model->updating_at = \Auth::user()->id;
            }
        });

        /**
         * Attach to the 'deleting' Model Event to provide a user id
         * for the `deleted_at` field (if logged in)
         */
        static::deleting(function ($model) {
            if (property_exists($model, 'deleted_at')) {
                if (@\Auth::user()) {
                    $model->deleting_at = \Auth::user()->id;
                }
            }
        });
    }
}
