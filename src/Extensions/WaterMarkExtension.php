<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use Silverstripe\SiteConfig\SiteConfig;
use Silverstripe\Director;


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
             $resource->insert($wimg, 'top-left', intval($clone->getWidth()*$config->posh/100-$config->watermarkimg->getImageBackend()->getWidth()/2), intval($backend->getHeight()*$config->posv/100-$config->watermarkimg->getImageBackend()->getHeight()/2));
             $clone->setImageResource($resource);
             
         
             return $clone;
        });
    }
    
public function InstagramText($amount = null){

$variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
             $clone = clone $backend;
             
             $resource = clone $backend->getImageResource();
            // draw filled red rectangle
				$resource->rectangle(0, 0, $clone->getWidth(), $clone->getHeight(), function ($draw) {
				    $draw->background('#991915');
				});
				
				// use callback to define details
				$resource->text('foo', 0, 0, function($font) {
   					$font->file(Director::baseFolder().'themes/simple/webfonts/Cambo-Regular-webfont.ttf.ttf');
    				$font->size(24);
    				$font->color('#fdf6e3');
    				$font->align('center');
  	  				$font->valign('top');
    				$font->angle(45);
});
             
             $clone->setImageResource($resource);
             
         
             return $clone;
        });
        

}

}
