<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Review extends BaseModel
{
    use  Resizable,Translatable;

    protected $translatable = ['alt'];

    public function getWebpImageAttribute()
    {
        return str_replace('.' . pathinfo(\Voyager::image($this->image),PATHINFO_EXTENSION), '.webp', \Voyager::image($this->image));
    }


    public function getBigThumbAttribute()
    {
        return \Voyager::image($this->getThumbnail($this->image,'big'));
    }
}
