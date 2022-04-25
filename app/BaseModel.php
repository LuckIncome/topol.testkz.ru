<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class BaseModel extends Model
{
    use Translatable, Resizable;

    protected $dates = ['created_at', 'updated_at'];


    /**
     * Set the user's first name.
     *
     * @param  string $value
     * @return void
     */
    public function setThumbnailAttribute($value)
    {
        if ($value) {
            $this->attributes['thumb'] = str_replace('.' . pathinfo(\Voyager::image($value),PATHINFO_EXTENSION), '-small.webp', \Voyager::image($value));
        } else {
            $this->attributes['thumb'] = '/images/nophoto.png';
        }
    }

    /**
     * Set the user's first name.
     *
     * @param  string $value
     * @return void
     */
    public function setThumbnailSmallAttribute($value)
    {
        if ($value) {
            $this->attributes['thumbnailSmall'] = str_replace('.' . pathinfo(\Voyager::image($value),PATHINFO_EXTENSION), '-small.webp', \Voyager::image($value));
        } else {
            $this->attributes['thumbnailSmall'] = '/images/nophoto.png';
        }
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
            $this->attributes['webp'] = str_replace('.' . pathinfo(\Voyager::image($value),PATHINFO_EXTENSION), '.webp', \Voyager::image($value));;
        } else {
            $this->attributes['webp'] = '/images/nophoto.png';
        }
    }

    public function getWebpImageAttribute()
    {
        return str_replace('.' . pathinfo(\Voyager::image($this->image),PATHINFO_EXTENSION), '.webp', \Voyager::image($this->image));
    }

    public function getBigThumbAttribute()
    {
        return
        \Voyager::image($this->getThumbnail($this->image,'big'));
    }

    public function getThumbicAttribute()
    {
        return $this->thumbnail('small', 'image');
    }
}
