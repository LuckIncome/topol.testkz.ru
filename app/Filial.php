<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Filial extends BaseModel
{
    use  Translatable;

    protected $translatable = ['name'];
    //

    public function contacts()
    {
        return $this->hasMany(Contact::class,'filial')->where('active',true)->orderBy('sort_id');
    }

    public function getPhonesAttribute()
    {
        if ( $this->contacts->where('type','phone')->count()){
            return $this->contacts->where('type','phone');
        }else {
            return Contact::where('is_main',true)->where('active',true)->where('type','phone')->first();
        }
    }

    public function getFaxAttribute()
    {
        if ( $this->contacts->where('type','fax')->count()){
            return $this->contacts->where('type','fax')->first();
        }else {
            return Contact::where('is_main',true)->where('active',true)->where('type','fax')->first();
        }
    }

    public function getGraphAttribute()
    {
        if ( $this->contacts->where('type','graph')->count()){
            return $this->contacts->where('type','graph')->first()->getTranslatedAttribute('value',session()->get('locale'),config('app.fallback_locale'));
        }else {
            return Contact::where('is_main',true)->where('active',true)->where('type','graph')->first()->getTranslatedAttribute('value',session()->get('locale'),config('app.fallback_locale'));
        }
    }

    public function getEmailAttribute()
    {
        if ( $this->contacts->where('type','email')->count()){
            return $this->contacts->where('type','email')->first();
        }else {
            return Contact::where('is_main',true)->where('active',true)->where('type','email')->first();
        }
    }

    public function getAddressAttribute()
    {
        if ( $this->contacts->where('type','address')->count()){
            return $this->contacts->where('type','address')->first()->getTranslatedAttribute('value',session()->get('locale'),config('app.fallback_locale'));
        }else {
            return Contact::where('is_main',true)->where('active',true)->where('type','address')->first()->getTranslatedAttribute('value',session()->get('locale'),config('app.fallback_locale'));
        }
    }

    public function getMapAttribute()
    {
        if ( $this->contacts->where('type','map')->count()){
            return $this->contacts->where('type','map')->first();
        }else {
            return Contact::where('is_main',true)->where('active',true)->where('type','map')->first();
        }
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
