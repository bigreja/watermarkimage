<?php
/**
 * Add field for member image on profile!
 *
 */
namespace bigreja\watermarkimage\Extensions;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\NumericField;

class watermarkimagesettings extends DataExtension
{

    private static $db = [
    	'alfa' => 'Int(10)',
    	'posh' => 'Int(0)',
    	'posv' => 'Int(0)',
    ];

	private static $has_one = array(
		'watermarkimg' =>  Image::class,
	);

	private static $owns = [
		'watermarkimg'
	];




   public function updateCMSFields(FieldList $fields)
{

        $image = new UploadField('watermarkimg', 'WaterMark Image');
        $image->setFolderName('watermarkimg');
        $image->getValidator()->setAllowedExtensions(['png','gif','jpeg','jpg']);

				$poshField = new NumericField('posh', 'Horisontal Position', null, 3);
				$posvField = 	new NumericField('posv', 'Vertical Position', null, 3);
				$alfaField = 	new NumericField('alfa', 'Alpha', null, 3);
					
        $fields->addFieldsToTab('Root.WatermarkSettings', $image);
        $fields->addFieldsToTab('Root.WatermarkSettings', $poshField);
        $fields->addFieldsToTab('Root.WatermarkSettings', $posvField);
        $fields->addFieldsToTab('Root.WatermarkSettings', $alfaField);
        
    }


public function getGridThumbnail()
    {
        // $this->owner refers to the original instance. In this case a `Member`.

        if($this->owner->watermarkimg()->exists()) {
            return $this->owner->watermarkimg()->ScaleMaxHeight(50);
        }

        return "(no image)";
    }

public function onAfterWrite()
{
    parent::onAfterWrite();
    if ($this->owner->watermarkimgID) {
        $this->owner->watermarkimg()->publishSingle();
    }
}

}
