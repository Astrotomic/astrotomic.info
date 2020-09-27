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
    public $contributors;

    /** @var \Illuminate\Support\Collection */
    public $trusts;

    public function __construct(array $parameters = [])
    {
        if (isset($parameters['contributors']) && is_array($parameters['contributors'])) {
            $parameters['contributors'] = collect($parameters['contributors'])->keyBy('login');
        }

        if (isset($parameters['trusts']) && is_array($parameters['trusts'])) {
            $parameters['trusts'] = collect($parameters['trusts'])->keyBy('slug');
        }

        parent::__construct($parameters);
    }

    public function getUrl(): string
    {
        return url('/');
    }
}
