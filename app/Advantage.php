<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Resizable;
use TCG\Voyager\Traits\Translatable;

class Advantage extends BaseModel
{
    use Translatable,Resizable;

    protected $translatable = ['icon_text','title','text'];

    public function getWebpImageAttribute()
    {
        return str_replace('.' . pathinfo(\Voyager::image($this->image),PATHINFO_EXTENSION), '.webp', \Voyager::image($this->image));
    }

    public function getBigThumbAttribute()
    {
        return  \Voyager::image($this->getThumbnail($this->image,'big'));
    }
}
