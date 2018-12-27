<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
/**
 * @property   string film_name
 * @property  string series_name
 * @property  string release_date
 * @property string url
 */
class Films extends Model
{
    use Searchable;

    public function toSearchableArray()
    {
        return [
            'film_name' => $this->film_name,
            'series_name' => $this->series_name,
        ];
    }

    protected $table = 'parser_films';
}
