# Laravel UUID Auditing

This package adds Traits for generating UUIDs and filling audit columns on Models, extends fico7489/laravel-pivot to add UUIDs to Pivot Tables

## Based On

This package is based on https://github.com/fico7489/laravel-pivot and using webpatser/laravel-uuid


## Install

1.Install package with composer
```
composer require beitsafe/laravel-uuid-auditing:"@dev"
```

## Configure Automatically


1. Use BeITSafe\Laravel\Models\BeITSafeModel trait in your base model or only in particular models. This will automatically generate UUIDs for BOTH Models and Pivot Tables.

```
...
use BeITSafe\Laravel\Models\BeITSafeModel;
 
class SomeModel extends BeITSafeModel
{
...
```


## Configure UUIDs Manually


1.Use BeITSafe\Laravel\Traits\Uuids trait in your base model or only in particular models. This will automatically generate UUIDs for BOTH Models and Pivot Tables.

```
...
use BeITSafe\Laravel\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use Uuids;
...
```

## Configure Auditing Manually


1.Use BeITSafe\Laravel\Traits\Auditing trait in your base model or only in particular models. This will automatically save the Auth::user()->id to 'created_by', 'updated_by', 'deleted_by' if there is a logged in User and the column exists in the Model.

```
...
use BeITSafe\Laravel\Traits\Auditing;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use Auditing;
...
```

## New eloquent events
 
New events are :

```
pivotAttaching, pivotAttached
pivotDetaching, pivotDetached,
pivotUpdating, pivotUpdated
```

License
----

MIT