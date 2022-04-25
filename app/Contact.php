<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Contact extends BaseModel
{
    use Translatable;

    protected $translatable = ['city', 'value'];

    public function filial()
    {
        return $this->belongsTo(Filial::class)->where('active',true)->orderBy('sort_id');
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
