<?php

namespace SimpleSoftwareIO\QrCode;

use InvalidArgumentException;

class ImageMerge
{
    /**
     * Holds the QrCode image.
     *
     * @var \SimpleSoftwareIO\QrCode\Image
     */
    protected $sourceImage;

    /**
     * Holds the merging image.
     *
     * @var \SimpleSoftwareIO\QrCode\Image
     */
    protected $mergeImage;

    /**
     * The height of the source image.
     *
     * @var int
     */
    protected $sourceImageHeight;

    /**
     * The width of the source image.
     *
     * @var int
     */
    protected $sourceImageWidth;

    /**
     * The height of the merge image.
     *
     * @var int
     */
    protected $mergeImageHeight;

    /**
     * The width of the merge image.
     *
     * @var int
     */
    protected $mergeImageWidth;

    /**
     * Holds the radio of the merging image.
     *
     * @var float
     */
    protected $mergeRatio;

    /**
     * The height of the merge image after it is merged.
     *
     * @var int
     */
    protected $postMergeImageHeight;

    /**
     * The width of the merge image after it is merged.
     *
     * @var int
     */
    protected $postMergeImageWidth;

    /**
     * The position that the merge image is placed on top of the source image.
     *
     * @var int
     */
    protected $centerY;

    /**
     * The position that the merge image is placed on top of the source image.
     *
     * @var int
     */
    protected $centerX;

    /**
     * Creates a new ImageMerge object.
     *
     * @param  \SimpleSoftwareIO\QrCode\Image  $sourceImage  Image The image that will be merged over.
     * @param \SimpleSoftwareIO\QrCode\Image  $mergeImage  Image The image that will be used to merge with $sourceImage
     */
    public function __construct(Image $sourceImage, Image $mergeImage)
    {
        $this->sourceImage = $sourceImage;
        $this->sourceImageHeight = $sourceImage->getHeight();
        $this->sourceImageWidth = $sourceImage->getWidth();

        $this->mergeImage = $mergeImage;
        $this->mergeImageHeight = $mergeImage->getHeight();
        $this->mergeImageWidth = $mergeImage->getWidth();
    }

    /**
     * Returns an QrCode that has been merge with another image.
     * This is usually used with logos to imprint a logo into a QrCode.
     *
     * @param  float  $percentage  The percentage of size relative to the entire QR of the merged image
     */
    public function merge(float $percentage): string|false
    {
        $this->setProperties($percentage);

        $img = \imagecreatetruecolor($this->sourceImage->getWidth(), $this->sourceImage->getHeight());
        \imagealphablending($img, true);
        $transparent = \imagecolorallocatealpha($img, 0, 0, 0, 127);
        \imagefill($img, 0, 0, $transparent);

        \imagecopy(
            $img,
            $this->sourceImage->getImageResource(),
            0,
            0,
            0,
            0,
            $this->sourceImage->getWidth(),
            $this->sourceImage->getHeight()
        );

        \imagecopyresampled(
            $img,
            $this->mergeImage->getImageResource(),
            $this->centerX,
            $this->centerY,
            0,
            0,
            $this->postMergeImageWidth,
            $this->postMergeImageHeight,
            $this->mergeImageWidth,
            $this->mergeImageHeight
        );

        $this->sourceImage->setImageResource($img);

        return $this->createImage();
    }

    /**
     * Creates a PNG Image.
     */
    protected function createImage(): string|false
    {
        \ob_start();
        imagepng($this->sourceImage->getImageResource());

        return \ob_get_clean();
    }

    /**
     * Sets the objects properties.
     *
     * @param  float  $percentage The percentage that the merge image should take up.
     */
    protected function setProperties(float $percentage): self
    {
        if ($percentage > 1) {
            throw new InvalidArgumentException('$percentage must be less than 1');
        }

        $this->calculateOverlap($percentage)->calculateCenter();

        return $this;
    }

    /**
     * Calculates the center of the source Image using the Merge image.
     */
    protected function calculateCenter(): self
    {
        $this->centerX = \intval(($this->sourceImageWidth / 2) - ($this->postMergeImageWidth / 2));
        $this->centerY = \intval(($this->sourceImageHeight / 2) - ($this->postMergeImageHeight / 2));

        return $this;
    }

    /**
     * Calculates the width of the merge image being placed on the source image.
     */
    protected function calculateOverlap(float $percentage): self
    {
        $this->mergeRatio = \round($this->mergeImageWidth / $this->mergeImageHeight, 2);
        $this->postMergeImageWidth = \intval($this->sourceImageWidth * $percentage);
        $this->postMergeImageHeight = \intval($this->postMergeImageWidth / $this->mergeRatio);

        return $this;
    }
}
