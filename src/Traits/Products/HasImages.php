<?php

namespace Suavy\LojaForLaravel\Traits\Products;

trait HasImages
{

    public function hasImages()
    {
        return !is_null($this->images) && is_array($this->images) && count($this->images) > 0;
    }

    public function getCountImagesAttribute()
    {
        return $this->hasImages() ? count($this->images) : 0;
    }

    public function getCoverAttribute()
    {
        if($this->hasImages()){
            return asset($this->images[0]);
        }else{
            return asset('images/photo-non-disponible.jpg');
        }
    }

    public function getImagesWithoutCoverAttribute()
    {
        if (! is_null($this->images) && is_array($this->images) && count($this->images)) {
            $images = $this->images;
            unset($images[0]);

            return $images;
        }

        return [];
    }
}
