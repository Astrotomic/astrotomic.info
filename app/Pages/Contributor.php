<?php

namespace App\Pages;

use Astrotomic\Stancy\Contracts\Routable;
use Astrotomic\Stancy\Models\PageData;
use Astrotomic\Stancy\Traits\PageHasContent;
use Astrotomic\Stancy\Traits\PageHasSlug;
use Astrotomic\Stancy\Traits\PageHasUrl;
use Illuminate\Support\Arr;

class Contributor extends PageData implements Routable
{
    use PageHasSlug, PageHasUrl;

    /** @var string */
    public $login;

    /** @var string */
    public $avatar_url;

    /** @var string */
    public $html_url;

    /** @var int */
    public $commits;

    /** @var string[] */
    public $packages;

    /** @var \Illuminate\Support\Collection */
    public $packagist;

    public function __construct(array $parameters = [])
    {
        if (isset($parameters['packagist']) && is_array($parameters['packagist'])) {
            $parameters['packagist'] = collect($parameters['packagist'])->keyBy('name');
        }

        parent::__construct(Arr::only($parameters, ['packagist', 'slug', 'login', 'avatar_url', 'commits', 'packages', 'html_url']));
    }

    public function getUrl(): string
    {
        return route('contributor', ['name' => strtolower($this->login)]);
    }
}
