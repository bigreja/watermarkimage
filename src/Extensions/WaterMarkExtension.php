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
            
             $wimg = clone $this->owner->watermarkimg->getImageBackend()->getImageResource();
			 $wimg->opacity($this->owner->alfa);
             $resource->insert($wimg, 'top-left', $this->owner->posv, $this->owner->posh);
             $clone->setImageResource($resource);
             
            return $clone;
        });
    }

}
