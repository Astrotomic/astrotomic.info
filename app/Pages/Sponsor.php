<?php

namespace App\Pages;

use Astrotomic\Stancy\Models\PageData;
use Astrotomic\Stancy\Traits\PageHasSlug;
use Illuminate\Support\Arr;

class Sponsor extends PageData
{
    use PageHasSlug;

    /** @var string */
    public $name;

    /** @var string */
    public $location;

    /** @var string */
    public $avatar_url;

    /** @var string */
    public $github_url;

    public function __construct(array $parameters = [])
    {
        parent::__construct(Arr::only($parameters, ['name', 'location', 'website', 'avatar_url', 'github_url']));
    }
}
