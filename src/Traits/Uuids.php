<?php

namespace BeITSafe\Laravel\UUIDAuditing\Traits;

use BeITSafe\Laravel\UUIDAuditing\Relations\BelongsToManyBeITSafe;
use BeITSafe\Laravel\UUIDAuditing\Traits\ExtendBelongsToMany;
use Webpatser\Uuid\Uuid;

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
            $model->{$model->getKeyName()} = (string)Uuid::generate();
        });

        /**
         * Attach to the 'creating' Model Event to provide a UUID
         * for the `id` field (provided by $model->getKeyName())
         */
        static::pivotAttaching(function ($model, $pivotRelation, $pivotIds, $pivotIdsAttributes) {
            $pivotRelation->attributes['id'] = (string)Uuid::generate();
        });

    }
}