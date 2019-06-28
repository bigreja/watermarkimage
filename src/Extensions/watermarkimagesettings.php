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

class watermarkimagesettings extends DataExtension
{

    private static $db = [
    	'alfa' => 'Int',
    	'posh' => 'Int',
    	'posv' => 'Int',
    ];

	private static $has_one = array(
		'watermarkimg' =>  Image::class,
	);

	private static $owns = [
		'watermarkimg'
	];



	private static $summary_fields = array(
		'GridThumbnail' => 'Profile Image'
	);

   public function updateCMSFields(FieldList $fields)
{

        $image = new UploadField('watermarkimg', 'WaterMark Image');
        $image->setFolderName('watermarkimg');
        $image->getValidator()->setAllowedExtensions(['png','gif','jpeg','jpg']);


        $fields->addFieldsToTab('Root.WatermarkSettings', $image);
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
