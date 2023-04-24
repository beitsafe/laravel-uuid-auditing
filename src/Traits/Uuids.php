<?php

namespace BeITSafe\Laravel\Traits;

use Illuminate\Support\Str;

trait Uuids
{

    use ExtendBelongsToMany;

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function bootUuids()
    {
        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Str::uuid()->toString();
        });

        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        static::pivotAttaching(function ($model, $pivotRelation, $pivotIds, $pivotIdsAttributes) {
            $pivotRelation->attributes['id'] = Str::uuid()->toString();
        });

    }
}