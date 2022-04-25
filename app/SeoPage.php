<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class SeoPage extends Model
{
    use Translatable;

    protected $translatable = ['meta_keywords', 'meta_description', 'meta_title'];

    protected $table = 'seopages';
}
