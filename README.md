# Laravel UUID Auditing

This package adds Traits for generating UUIDs and filling audit columns on Models, extends fico7489/laravel-pivot to add UUIDs to Pivot Tables

## Based On

This package is based on https://github.com/fico7489/laravel-pivot and using webpatser/laravel-uuid


## Install

1.Install package with composer
```
composer require beitsafe/laravel-uuid-auditing:"@dev"
```

## Configure UUIDs


1.Use BeITSafe\Laravel\UUIDAuditing\Traits\Uuids trait in your base model or only in particular models. This will automatically generate UUIDs for BOTH Models and Pivot Tables.

```
...
use BeITSafe\Laravel\UUIDAuditing\Traits\Uuids;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use Uuids;
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