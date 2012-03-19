<?php

/**
 * Description of ImageProcessor
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class ImageProcessor extends CComponent
{
    public $image;
    public $imageType;

    public function __construct($filename)
    {
        $imageInfo = getimagesize($filename);
        $this->imageType = $imageInfo[2];

        switch ($this->imageType)
        {
            case IMAGETYPE_JPEG:
                $this->image = imagecreatefromjpeg($filename);
                break;
            case IMAGETYPE_GIF:
                $this->image = imagecreatefromgif($filename);
                break;
            case IMAGETYPE_PNG:
                $this->image = imagecreatefrompng($filename);
                break;
            default:
                throw new CException('Image type not supported');
                break;
        }
    }

    function save($filename, $imageType = IMAGETYPE_JPEG, $compression = 75)
    {
        switch ($imageType)
        {
            case IMAGETYPE_JPEG:
                imagejpeg($this->image, $filename, $compression);
                break;
            case IMAGETYPE_GIF:
                imagegif($this->image, $filename);
                break;
            case IMAGETYPE_PNG:
                imagepng($this->image, $filename);
                break;
            default:
                throw new CException('Image type not supported');
                break;
        }
    }

    function getWidth()
    {
        return imagesx($this->image);
    }

    function getHeight()
    {
        return imagesy($this->image);
    }

    function resizeToHeight($height)
    {
        $ratio = $height / $this->height;
        $width = $this->width * $ratio;
        $this->resize($width, $height);
    }

    function resizeToWidth($width)
    {
        $ratio = $width / $this->width;
        $height = $this->height * $ratio;
        $this->resize($width, $height);
    }

    function scale($scale)
    {
        $width = $this->width * $scale / 100;
        $height = $this->heigh * $scale / 100;
        $this->resize($width, $height);
    }

    function resize($width, $height)
    {
        $newImage = imagecreatetruecolor($width, $height);
        imagecopyresampled($newImage, $this->image, 0, 0, 0, 0, $width, $height, $this->width, $this->height);
        $this->image = $newImage;
    }

}