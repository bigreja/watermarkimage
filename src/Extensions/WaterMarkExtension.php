<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;


class WaterMarkExtension extends Extension
{
    
    
    public function WaterMark($amount = null)
    {
        	Debug::Show($this->owner->watermarkimg);
			Debug::Show($this->owner->watermarkimg->getWidth());
			Debug::Show($this->owner->watermarkimg->getHeight());
			
            Debug::Show($this->PercentageX());
            Debug::Show($this->PercentageY());
			
		$variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            
             //$wimg = clone $this->owner->watermarkimg()->getImageResource();
			 //$wimg->opacity($this->owner->alfa);
             //$resource->insert($wimg, 'center', $this->PercentageX(), $this->PercentageY());
             // $clone->setImageResource($resource);
			
             
            return $clone;
        });
    }
    
    public function PercentageX()
    {
        if ($field = $this->owner->watermarkimg) {
            return round($field->getWidth() * $this->owner->posv)/100;
        }
        return 0;
    }
    public function PercentageY()
    {
        if ($field = $this->owner->watermarkimg) {
            return round($field->getHeight() * $this->owner->posh)/100;
        }
        return 0;
    }

}
