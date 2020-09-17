<?php

namespace Suavy\LojaForLaravel\Traits\Products;

trait HasImages
{
    public function getCoverAttribute(){
        if(!is_null($this->images) && is_array($this->images) && count($this->images)){
            return $this->images[0];
        }
        return 'images/no-cover.png';
    }

    public function getImagesWithoutCoverAttribute(){
        if(!is_null($this->images) && is_array($this->images) && count($this->images)){
            $images = $this->images;
            unset($images[0]);
            return $images;
        }
        return [];
    }
}
