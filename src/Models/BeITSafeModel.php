<?php

namespace BeITSafe\Laravel\Models;

use BeITSafe\Laravel\Traits\Auditing;
use BeITSafe\Laravel\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

class BeITSafeModel extends Model
{

    public $timestamps = true;
    public $incrementing = false;

    use Uuids, Auditing;

    /**
     * Returns the User that created the record if 'created_by' filled
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * Returns the User that last updated the record if 'updated_by' filled
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function updator()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
    }

    /**
     * Returns the User that deleted the record if 'deleted_by' filled
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function deletor()
    {
        return $this->belongsTo('App\Modes\User', 'deleted_by');
    }
}
