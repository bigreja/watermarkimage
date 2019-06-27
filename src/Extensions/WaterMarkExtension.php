<?php

namespace bigreja\watermarkimage\Extensions;

use SilverStripe\Core\Extension;
class WaterMarkExtension extends Extension
{
    public function Square($width)
    {
        $variant = $this->owner->variantName(__FUNCTION__, $width);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use($width) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            $resource->fit($width);
            $clone->setImageResource($resource);
            return $clone;
        });
    }

    public function Blur($amount = null)
    {
        $variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            $resource->blur($amount);
            $clone->setImageResource($resource);
            return $clone;
        });
    }

    public function WaterMark($amount = null)
    {
        $variant = $this->owner->variantName(__FUNCTION__, $amount);
        return $this->owner->manipulateImage($variant, function (\SilverStripe\Assets\Image_Backend $backend) use ($amount) {
            $clone = clone $backend;
            $resource = clone $backend->getImageResource();
            $resource->insert('themes/superbraga/images/logo/sob-sb.png');
            $clone->setImageResource($resource);
            return $clone;
        });
    }

}
