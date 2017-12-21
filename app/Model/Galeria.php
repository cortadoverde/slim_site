<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Galeria extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'galeria';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function images()
    {
      return $this->belongsToMany(\App\Model\Image::class, 'galeria_images', 'galeria_id', 'image_id');
    }
}
