<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Product extends BaseModel
{
    use Translatable,Resizable;

    protected $translatable = ['name','excerpt','description','specifications','features','seo_title','meta_description','meta_keywords'];


    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $dates = ['created_at','updated_at'];

    public function categoryId()
    {
        return $this->belongsTo(Category::class)->where('active',true);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->category;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }


    public function getLinkAttribute()
    {
        $categories = $this->category->parents->reverse();
        $categories->push($this->category);
        $categories->push($this);
        return $this->category ? '/catalog/' . $categories->pluck('slug')->implode('/') : false;
    }

    public static function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('slug', 'like', '%' . $searchTerm . '%')
            ->orWhere('brand', 'like', '%' . $searchTerm . '%')
            ->orWhere(function ($q) use ($searchTerm){
                $q->whereTranslation('name', 'like', '%' . $searchTerm . '%');
            })->orWhere(function ($q) use ($searchTerm){
                $q->whereTranslation('brand', 'like', '%' . $searchTerm . '%');
            });
    }

    public function getProductsAttribute()
    {
        if(unserialize($this->relateds)){
            return Product::whereIn('id',unserialize($this->relateds))->where('active',true)->orderBy('sort_id')->get();
        }else {
            return collect([]);
        }

    }

    public function getWebpImageAttribute()
    {
        return str_replace('.' . pathinfo(\Voyager::image($this->image), PATHINFO_EXTENSION), '.webp', \Voyager::image($this->image));
    }


    public function getBigThumbAttribute()
    {
        return \Voyager::image($this->getThumbnail($this->image,'big'));
    }
}
