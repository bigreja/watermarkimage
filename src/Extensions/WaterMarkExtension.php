<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\SiteConfig\SiteConfig;
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
            
             $config = SiteConfig::current_site_config();
   			 $wimg = $config->watermarkimg();
			 //$wimg->opacity($config->alpha);
            $resource->insert($wimg);
        
            $clone->setImageResource($resource, 'top-left', $config->posv, $config->posh);
            return $clone;
        });
    }

}
