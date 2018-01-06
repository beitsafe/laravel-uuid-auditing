# Laravel UUID Auditing

This package adds Traits for generating UUIDs and filling audit columns on Models, extends fico7489/laravel-pivot to add UUIDs to Pivot Tables

## Based On

This package is based on https://github.com/fico7489/laravel-pivot


## Install

1.Install package with composer
```
composer require beitsafe/laravel-uuid-auditing
```


2.Use Fico7489\Laravel\Pivot\Traits\PivotEventTrait trait in your base model or only in particular models.

```
...
use Fico7489\Laravel\Pivot\Traits\PivotEventTrait;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use PivotEventTrait;
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