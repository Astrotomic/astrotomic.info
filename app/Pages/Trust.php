<?php

namespace App\Pages;

use Astrotomic\Stancy\Contracts\Routable;
use Astrotomic\Stancy\Models\PageData;
use Astrotomic\Stancy\Traits\PageHasSlug;
use Astrotomic\Stancy\Traits\PageHasUrl;
use Illuminate\Support\Arr;

class Trust extends PageData
{
    use PageHasSlug;

    /** @var string */
    public $name;

    /** @var string */
    public $location;

    /** @var string */
    public $website;

    /** @var string */
    public $image;

    public function __construct(array $parameters = [])
    {
        parent::__construct(Arr::only($parameters, ['name', 'location', 'website', 'image']));
    }
}
