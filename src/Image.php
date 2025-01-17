<?php

namespace SimpleSoftwareIO\QrCode;

class Image
{
    /**
     * Holds the image resource.
     *
     * @var \GdImage
     */
    protected $image;

    /**
     * Creates a new Image object.
     * 
     * @throws \Exception
     */
    public function __construct(string $image)
    {
        $gdImage = \imagecreatefromstring($image);
        if (!($gdImage instanceof \GdImage)) {
            throw new \Exception('Can\'t create image from given string.');
        }

        $this->image = $gdImage;
    }

    /*
     * Returns the width of an image
     */
    public function getWidth(): int|false
    {
        return \imagesx($this->image);
    }

    /*
     * Returns the height of an image
     */
    public function getHeight(): int|false
    {
        return \imagesy($this->image);
    }

    /**
     * Returns the image string.
     */
    public function getImageResource(): \GdImage
    {
        return $this->image;
    }

    /**
     * Sets the image string.
     */
    public function setImageResource(\GdImage $image): self
    {
        $this->image = $image;

        return $this;
    }
}
