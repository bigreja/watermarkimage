<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;

class WaterMarkExtension extends Extension
{
    
    
    public function WaterMark($amount = null)
    {
        $variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            
             $wimg = clone $this->owner->watermarkimg()->getImageBackend()->getImageResource();
			 $wimg->opacity($this->owner->alfa);
             $resource->insert($wimg, 'center', $this->PercentageX(), $this->PercentageY());
             $clone->setImageResource($resource);

            Debug::Show($this->PercentageX());
            Debug::Show($this->PercentageY());

             
            return $clone;
        });
    }
    
    public function PercentageX()
    {
        if ($field = $this->owner->watermarkimg->exists()) {
            return round($field->getWidth() * $this->owner->posv)/100;
        }
        return 0;
    }
    public function PercentageY()
    {
        if ($field = $this->owner->watermarkimg->exists()) {
            return round($field->getHeight() * $this->owner->posh)/100;
        }
        return 0;
    }

}
