<?php

namespace BeITSafe\Laravel\UUIDAuditing\Relations;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Fico7489\Laravel\Pivot\Relations\BelongsToManyCustom;

class BelongsToManyBeITSafe extends BelongsToManyCustom
{
    /**
     * Attributes to be attched or updating in the pivot table
     *
     * @var array
     */
    public $attributes = [];

    /**
     * Attach a model to the parent.
     *
     * @param  mixed  $id
     * @param  array  $attributes
     * @param  bool   $touch
     * @return void
     */
    public function attach($ids, array $attributes = [], $touch = true)
    {
        list($idsOnly, $idsAttributes) = $this->getIdsWithAttributes($ids, $attributes);

        $this->parent->fireModelEvent('pivotAttaching', true, $this, $idsOnly, $idsAttributes);
        BelongsToMany::attach($ids, $this->attributes, $touch);
        $this->parent->fireModelEvent('pivotAttached', false, $this, $idsOnly, $idsAttributes);
    }

    /**
     * Update an existing pivot record on the table.
     *
     * @param  mixed  $id
     * @param  array  $attributes
     * @param  bool   $touch
     * @return int
     */
    public function updateExistingPivot($id, array $attributes, $touch = true)
    {
        list($idsOnly, $idsAttributes) = $this->getIdsWithAttributes($id, $attributes);

        $this->parent->fireModelEvent('pivotUpdating', true, $this, $idsOnly, $idsAttributes);
        BelongsToMany::updateExistingPivot($id, $this->attributes, $touch);
        $this->parent->fireModelEvent('pivotUpdated', false, $this, $idsOnly, $idsAttributes);
    }

    /**
     * Cleans the ids and ids with attributes
     * Returns an array with and array of ids and array of id => attributes
     *
     * @param  mixed  $id
     * @param  array  $attributes
     * @return array
     */
    private function getIdsWithAttributes($id, $attributes = [])
    {
        $ids = [];

        if ($id instanceof Model) {
            $ids[$id->getKey()] = $attributes;
        } elseif ($id instanceof Collection) {
            foreach ($id as $model) {
                $ids[$model->getKey()] = $attributes;
            }
        } elseif (is_array($id)) {
            foreach ($id as $key => $attributesArray) {
                if (is_array($attributesArray)) {
                    $ids[$key] = array_merge($attributes, $attributesArray);
                } else {
                    $ids[$attributesArray] = $attributes;
                }
            }
        } elseif (is_int($id)) {
            $ids[$id] = $attributes;
        }

        $idsOnly = array_keys($ids);

        return [$idsOnly, $ids];
    }
}