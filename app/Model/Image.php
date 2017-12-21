<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'images';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function galerias()
    {
      return $this->belongsToMany(\App\Model\Galeria::class, 'galeria_images', 'image_id', 'galeria_id');
    }

    public function sections()
    {
      return $this->hasMany(\App\Model\Section::class, 'image_id');
    }
}
