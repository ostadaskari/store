<?php

namespace App\Models\Warehouse;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $connection = 'warehouse';

    protected $table = 'categories';
    public $timestamps = false;
    protected $appends = ['full_path_slug'];


    protected $fillable = ['id','name', 'slug','parent_id','created_at'];

    // parent (belongsTo)
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    // direct children (hasMany)
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    // recursive children for eager loading
    public function childrenRecursive()
    {
        return $this->children()->with('childrenRecursive');
    }
    public function allDescendantIds()
    {
        $ids = collect([$this->id]);

        foreach ($this->children as $child) {
            $ids = $ids->merge($child->allDescendantIds());
        }

        return $ids;
    }
    public function getAllChildrenIds()
    {
        $ids = [];

        foreach ($this->children as $child) {
            $ids[] = $child->id;
            $ids = array_merge($ids, $child->getAllChildrenIds());
        }

        return $ids;
    }


    // full category path accessor
    // ✅ Recursively build full path slug (handles unlimited depth)
    public function getFullPathSlugAttribute()
    {
        $path = [$this->slug];
        $parent = $this->parent;

        while ($parent) {
            array_unshift($path, $parent->slug); // prepend parent slug
            $parent = $parent->parent;
        }

        return implode('/', $path);
    }

    public function products(){
        return $this->hasMany(Product::class, 'category_id');
    }
}
