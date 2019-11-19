<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
use SilverStripe\Assets\Image;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Dev\Debug;
use SilverStripe\Dev\Backtrace;
use Silverstripe\SiteConfig\SiteConfig;
use Silverstripe\Control\Director;


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
				
				Debug::Show(Director::baseFolder().'themes/simple/webfonts/Cambo-Regular-webfont.ttf');
				exit();
				// use callback to define details
				$resource->text('foo', 0, 0, function($font) {
   					$font->file(Director::baseFolder().'themes/simple/webfonts/Cambo-Regular-webfont.ttf');
    				$font->size(24);
    				$font->color('#fdf6e3');
    				$font->align('center');
  	  				$font->valign('top');
    				//$font->angle(45);
});
             
             $clone->setImageResource($resource);
             
         
             return $clone;
        });
        

}

public function InstagramTextHard($amount = null){

$variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
             $clone = clone $backend;

             $resource = clone $backend->getImageResource();
            // draw filled red rectangle
            //Debug::Show( $clone->getHeight()-205);
			//Debug::Show(intval($clone->getHeight()/2));

				$resource->rectangle(5, intval($clone->getHeight()/2), $clone->getWidth()-5,  intval($clone->getHeight()-5), function ($draw) {
				    $draw->background('rgba(153, 25, 31, 0.5)');
				});

				// use callback to define details
				$resource->text("Badamerda isto nao deve \nfazer quebra de texto", 10, $clone->getHeight()-50, function($font) {
   					$font->file(Director::baseFolder().'/themes/simple/webfonts/Cambo-Regular-webfont.ttf');
    				$font->size(20);
    				$font->color('#FFFFFF');
    				$font->align('left');
  	  				$font->valign('top');

});

             $clone->setImageResource($resource);


             return $clone;
        });


}


}
