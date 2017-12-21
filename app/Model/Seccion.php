<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Seccion extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'section';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function images()
    {
      return $this->belongsTo(\App\Model\Image::class, 'image_id');
    }
}
