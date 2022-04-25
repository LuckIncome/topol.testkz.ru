<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Service extends BaseModel
{
    use  Translatable,Resizable;

    protected $translatable = ['title', 'seo_title', 'excerpt', 'body','body_footer', 'slug', 'meta_description', 'meta_keywords'];
    /**
     * Get the route key for the model.
     *
     * @return string
     */

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $dates = ['created_at','updated_at'];


    public static function scopeSearch($query, $searchTerm)
    {
        return $query->where('title', 'like', '%' .$searchTerm. '%')
            ->orWhere('slug', 'like', '%' .$searchTerm. '%')->orWhere(function ($q) use ($searchTerm){
                $q->whereTranslation('title', 'like', '%' . $searchTerm . '%');
            });
    }

    public function getWebpImageAttribute()
    {
        return str_replace('.' . pathinfo(\Voyager::image($this->image),PATHINFO_EXTENSION), '.webp', \Voyager::image($this->image));
    }

    public function getBigThumbAttribute()
    {
        return \Voyager::image($this->getThumbnail($this->image,'big'));
    }
}
