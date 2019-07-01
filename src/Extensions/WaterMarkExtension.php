<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use Silverstripe\SiteConfig\SiteConfig;


class WaterMarkExtension extends Extension
{
    
    
    public function WaterMark($amount = null)
    {
			
		$variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
             $clone = clone $backend;
             $resource = clone $backend->getImageResource();
            
             $config = SiteConfig::current_site_config();
   			 $wimg = clone $config->watermarkimg->getImageBackend()->getImageResource();
			 $wimg->opacity($config->alfa);
             $resource->insert($wimg, 'center', $config->posv, $config->posh);
             $clone->setImageResource($resource);
             return $clone;
        });
    }
    
  

}
