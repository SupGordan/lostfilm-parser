<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property   string film_name
 * @property  string series_name
 * @property  string release_date
 * @property string url
 */
class Films extends Model
{
    protected $table = 'parser_films';
}
