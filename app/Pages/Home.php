<?php

namespace App\Pages;

use Astrotomic\Stancy\Contracts\Routable;
use Astrotomic\Stancy\Models\PageData;
use Astrotomic\Stancy\Traits\PageHasContent;
use Astrotomic\Stancy\Traits\PageHasSlug;
use Astrotomic\Stancy\Traits\PageHasUrl;

class Home extends PageData implements Routable
{
    use PageHasContent, PageHasSlug, PageHasUrl;

    /** @var \Illuminate\Support\Collection */
    public $packagist;

    /** @var \Illuminate\Support\Collection */
    public $contributors;

    public function __construct(array $parameters = [])
    {
        if (isset($parameters['packagist']) && is_array($parameters['packagist'])) {
            $parameters['packagist'] = collect($parameters['packagist'])->keyBy('name');
        }

        if (isset($parameters['contributors']) && is_array($parameters['contributors'])) {
            $parameters['contributors'] = collect($parameters['contributors'])->keyBy('login');
        }

        parent::__construct($parameters);
    }

    public function getUrl(): string
    {
        return url('/');
    }
}
