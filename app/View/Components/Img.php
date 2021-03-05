<?php

namespace App\View\Components;

use Astrotomic\Imgix\Facades\Imgix;
use Illuminate\Support\Str;

class Img
{
    private array $params = [];
    private string $src;

    public ?int $width;
    public ?int $height;

    public function __construct(
        string $src,
        ?int $width = null,
        ?int $height = null,
        ?string $ratio = null,
        bool $crop = false,
        ?string $trim = null
    ) {
        $this->src = $src;
        $this->setWidth($width);
        $this->setHeight($height);

        if (
            app()->environment('prod')
            && Str::startsWith($this->src, 'http')
            && ! Str::startsWith($this->src, asset(''))
        ) {
            $this->src .= (Str::contains($this->src, '?') ? '&' : '?').'md5='.hash_file('md5', $this->src);
        }
        $this->src = url($this->src);

        $this->params['auto'] = 'compress';
        $this->params['fit'] = 'max';

        if ($ratio) {
            $crop = true;
            $this->params['ar'] = $ratio;

            if ($width !== null && $height === null) {
                $this->setHeight($width / explode(':', $ratio)[0] * explode(':', $ratio)[1]);
            }

            if ($width === null && $height !== null) {
                $this->setWidth($height / explode(':', $ratio)[1] * explode(':', $ratio)[0]);
            }
        }

        if ($crop) {
            $this->params['fit'] = 'crop';
            $this->params['crop'] = 'edges';
        }

        if ($trim) {
            $this->params['trim'] = 'auto';
            if (Str::startsWith($trim, '#')) {
                $this->params['trim'] = 'color';
                $this->params['trim-color'] = Str::after($trim, '#');
            }
        }
    }

    public function src(?string $format = null): string
    {
        if (app()->environment('local')) {
            return asset($this->src);
        }

        return Imgix::createURL(
            $this->src,
            array_merge($this->params, array_filter(['fm' => $format]))
        );
    }

    public function srcSet(?string $format = null, array $options = []): string
    {
        if (app()->environment('local')) {
            return asset($this->src).' 1x';
        }

        return Imgix::createSrcSet(
            $this->src,
            array_merge($this->params, array_filter(['fm' => $format])),
            $options
        );
    }

    protected function setHeight(?int $height): self
    {
        $this->height = $height;

        if ($height) {
            $this->params['h'] = $height;
        } else {
            unset($this->params['h']);
        }

        return $this;
    }

    protected function setWidth(?int $width): self
    {
        $this->width = $width;

        if ($width) {
            $this->params['w'] = $width;
        } else {
            unset($this->params['w']);
        }

        return $this;
    }
}
