<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use TCG\Voyager\Traits\Resizable;

class Category extends \TCG\Voyager\Models\Category
{
    use Resizable;

    protected $translatable = ['slug', 'name', 'excerpt'];

    protected $table = 'categories';

    protected $fillable = ['slug', 'name', 'excerpt', 'image','filters', 'bg', 'active', 'order', 'parent_id'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function categories()
    {
        return $this->hasMany(self::class, 'parent_id')->where('active', true)
            ->orderBy('order', 'ASC');
    }

    public function parent()
    {
        return $this->parentId();
    }

    public function filters(): array
    {
        return $this->filters === null ? [] : $this->filters;
    }

    public function filtersList()
    {
        $products = $this->products;
        $options = [];
        if ($products->count()) {
            foreach ($products as $product) {
                $product->getAttributes();
                foreach (unserialize($product->specifications) as $option) {
                    if ($option['name'] != null && $option['value'] != null) {
                        if (!in_array($option, $options))
                            array_push($options, $option);
                        $product->setAttribute($option['name'] ? $option['name'] : "", $option['value'] ? $option['value'] : '');

                    }
                }
                foreach (unserialize($product->features) as $option) {
                    if ($option['name'] != null && $option['value'] != null) {
                        if (!in_array($option, $options))
                            array_push($options, $option);
                        $product->setAttribute($option['name'] ? $option['name'] : "", $option['value'] ? $option['value'] : '');

                    }
                }
            }
            $brands = $products->groupBy('brand')->keys();
            $options_key = collect($options)->groupBy('name')->keys();
            $options = collect($options)->unique('value')->groupBy('name');
            $result_options = [];
            $result_options[] = 'Бренд';
            foreach ($options as $key => $option) {
                foreach ($option as $item) {
                    if (!array_key_exists($item['name'], array_keys($result_options))) {
                        $result_options[] = $item['name'];
                    }
                }
            }
            $result = [];
            $result_options = array_unique($result_options);
            foreach ($result_options as $option) {
                $values = ['name'=>$option,'value'=> $option];
                if (!in_array($values,$result)){
                    $result[] = $values;
                }
            }
            return collect($result);
        } else {
            return collect([]);
        }
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while (!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }


    public function getLinkAttribute()
    {
        $categories = $this->parents->reverse();
        $categories->push($this);
        return '/catalog/' . $categories->pluck('slug')->implode('/');

    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id')->where('active', true);
    }

    public function parentId()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public static function scopeSearch($query, $searchTerm)
    {
        return $query->where('name', 'like', '%' . $searchTerm . '%')
            ->orWhere('slug', 'like', '%' . $searchTerm . '%')->orWhere(function ($q) use ($searchTerm) {
                $q->whereTranslation('name', 'like', '%' . $searchTerm . '%');
            });
    }

    /**
     * Set the user's first name.
     *
     * @param  string $value
     * @return void
     */
    public function setWebpAttribute($value)
    {
        if ($value) {
            $this->attributes['webp'] = str_replace('.' . pathinfo(\Voyager::image($value), PATHINFO_EXTENSION), '.webp', \Voyager::image($value));;
        } else {
            $this->attributes['webp'] = '/images/nophoto.png';
        }
    }

    public function getWebpImageAttribute()
    {
        return str_replace('.' . pathinfo(\Voyager::image($this->image), PATHINFO_EXTENSION), '.webp', \Voyager::image($this->image));
    }


    public function getBigThumbAttribute()
    {
        return \Voyager::image($this->getThumbnail($this->image, 'big'));
    }

    public function getThumbicAttribute()
    {
        return $this->thumbnail('small', 'image');
    }
}
