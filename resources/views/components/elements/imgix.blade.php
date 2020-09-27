<?php /** @var App\View\Components\Img $img */ ?>
@php($img = app(\App\View\Components\Img::class, [
    'src' => $src,
    'width' => $width ?? null,
    'height' => $height ?? null,
    'ratio' => $ratio ?? null,
    'crop' => $crop ?? false,
    'trim' => $trim ?? null,
]))

<picture>
    <source type="image/webp" srcset="{{ $img->srcSet('webp') }}"/>
    <img
        src="{{ $img->src() }}"
        srcset="{{ $img->srcSet() }}"
        @if($img->width) width="{{ $img->width }}" @endif
        @if($img->height) height="{{ $img->height }}" @endif
        @if($alt) alt="{{ $alt }}" @endif
        loading="lazy"
        class="{{ $class ?? '' }}"
    />
</picture>
