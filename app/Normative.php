<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Normative extends Model
{
    use Translatable;

    protected $dates = ['created_at','updated_at'];

    protected $translatable = ['title'];
}
