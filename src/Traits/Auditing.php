<?php

namespace BeITSafe\Laravel\Traits;

use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

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
                if (@\Auth::check() && @\Auth::user()->id) {
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
                if (@\Auth::check() && @\Auth::user()->id) {
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
                if (@\Auth::check() && @\Auth::user()->id) {
                    $model->deleted_by = \Auth::user()->id;
                    $model->save();
                }
            }
        });

        /**
         * Attach to the 'pivotAttaching' Model Event to provide the UUID
         * of the logged in user to the 'created_by' column and current
         * timestamp to the 'created_at' column if the column exists and
         * there is a user logged in
         */
        static::pivotAttaching(function ($model, $pivotRelation, $pivotIds, $pivotIdsAttributes) {
            if (Schema::hasColumn($pivotRelation->getTable(), 'created_by')) {
                if (@\Auth::check() && @\Auth::user()->id) {
                    $pivotRelation->attributes['created_by'] = \Auth::user()->id;
                }
            }
            if (Schema::hasColumn($pivotRelation->getTable(), 'created_at')) {
                $pivotRelation->attributes['created_at'] = Carbon::now();
            }
        });

        /**
         * Attach to the 'pivotAttaching' Model Event to provide the UUID
         * of the logged in user to the 'deleted_by' column and current
         * timestamp to the 'deleted_at' column if the column exists and
         * there is a user logged in
         */
        static::pivotDetaching(function ($model, $pivotRelation, $pivotIds, $pivotIdsAttributes) {
            if (Schema::hasColumn($pivotRelation->getTable(), 'deleted_by')) {
                if (@\Auth::check() && @\Auth::user()->id) {
                    $pivotRelation->attributes['deleted_by'] = \Auth::user()->id;
                }
            }
            if (Schema::hasColumn($pivotRelation->getTable(), 'deleted_at')) {
                $pivotRelation->attributes['deleted_at'] = Carbon::now();
            }
        });

        /**
         * Attach to the 'pivotAttaching' Model Event to provide the UUID
         * of the logged in user to the 'updated_by' column and current
         * timestamp to the 'updated_at' column if the column exists and
         * there is a user logged in
         */
        static::pivotUpdating(function ($model, $pivotRelation, $pivotIds, $pivotIdsAttributes) {
            if (Schema::hasColumn($pivotRelation->getTable(), 'updated_by')) {
                if (@\Auth::check() && @\Auth::user()->id) {
                    $pivotRelation->attributes['updated_by'] = \Auth::user()->id;
                }
            }
            if (Schema::hasColumn($pivotRelation->getTable(), 'updated_at')) {
                $pivotRelation->attributes['updated_at'] = Carbon::now();
            }
        });
    }
}