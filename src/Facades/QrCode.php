<?php

namespace SimpleSoftwareIO\QrCode\Facades;

use Illuminate\Support\Facades\Facade;
use SimpleSoftwareIO\QrCode\Generator;

/**
 * @method static \Illuminate\Support\HtmlString|string|null generate(string $text, ?string $filename = null)
 * @method static \SimpleSoftwareIO\QrCode\Generator merge(string $filepath, float $percentage = .2, bool $absolute = false)
 * @method static \SimpleSoftwareIO\QrCode\Generator mergeString(string $content, float $percentage = .2)
 * @method static \SimpleSoftwareIO\QrCode\Generator size(int $pixels)
 * @method static \SimpleSoftwareIO\QrCode\Generator format(string $format)
 * @method static \SimpleSoftwareIO\QrCode\Generator color(int $red, int $green, int $blue, ?int $alpha = null)
 * @method static \SimpleSoftwareIO\QrCode\Generator backgroundColor(int $red, int $green, int $blue, ?int $alpha = null)
 * @method static \SimpleSoftwareIO\QrCode\Generator eyeColor(int $eyeNumber, int $innerRed, int $innerGreen, int $innerBlue, int $outterRed = 0, int $outterGreen = 0, int $outterBlue = 0)
 * @method static \SimpleSoftwareIO\QrCode\Generator gradient($startRed, $startGreen, $startBlue, $endRed, $endGreen, $endBlue, string $type)
 * @method static \SimpleSoftwareIO\QrCode\Generator eye(string $style)
 * @method static \SimpleSoftwareIO\QrCode\Generator style(string $style, float $size = 0.5)
 * @method static \SimpleSoftwareIO\QrCode\Generator encoding(string $encoding)
 * @method static \SimpleSoftwareIO\QrCode\Generator errorCorrection(string $errorCorrection)
 * @method static \SimpleSoftwareIO\QrCode\Generator margin(int $margin)
 * @method static \BaconQrCode\Writer getWriter(ImageRenderer $renderer)
 * @method static \BaconQrCode\ImageRenderer getRenderer()
 * @method static \BaconQrCode\Renderer\RendererStyle\RendererStyle getRendererSytle()
 * @method static \BaconQrCode\Renderer\Image\ImageBackEndInterface getFormatter()
 * @method static \BaconQrCode\Renderer\Module\ModuleInterface getModule()
 * @method static \BaconQrCode\Renderer\Eye\EyeInterface getEye()
 * @method static \BaconQrCode\Renderer\RendererStyle\Fill getFill()
 * @method static \BaconQrCode\Renderer\Color\ColorInterface createColor(int $red, int $green, int $blue, ?int $alpha = null)
 * @method static \Illuminate\Support\HtmlString|string|null BTC(string $address, string $amount, array $option = null)
 * @method static \Illuminate\Support\HtmlString|string|null Email(string $email, string $subject, string $body)
 * @method static \Illuminate\Support\HtmlString|string|null Geo(float $latitude, float $longitude)
 * @method static \Illuminate\Support\HtmlString|string|null PhoneNumber(string $phoneNumber)
 * @method static \Illuminate\Support\HtmlString|string|null SMS(string $phoneNumber, string $message)
 * @method static \Illuminate\Support\HtmlString|string|null WiFi(string $phoneNumber, string $message)
 *
 * @see \SimpleSoftwareIO\QrCode\Generator
 */
class QrCode extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        self::clearResolvedInstance(Generator::class);

        return Generator::class;
    }
}
