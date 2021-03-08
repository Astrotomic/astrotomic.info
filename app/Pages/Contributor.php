<?php

namespace App\Pages;

use Astrotomic\Stancy\Contracts\Routable;
use Astrotomic\Stancy\Models\PageData;
use Astrotomic\Stancy\Traits\PageHasSlug;
use Astrotomic\Stancy\Traits\PageHasUrl;

class Contributor extends PageData implements Routable
{
    use PageHasSlug, PageHasUrl;

    public $id;
    public $node_id;
    public $gravatar_id;
    public $url;
    public $followers_url;
    public $following_url;
    public $gists_url;
    public $starred_url;
    public $subscriptions_url;
    public $organizations_url;
    public $repos_url;
    public $events_url;
    public $received_events_url;
    public $type;
    public $site_admin;

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

    public $info;

    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);
    }

    public function getUrl(): string
    {
        return route('contributor', ['name' => strtolower($this->login)]);
    }
}
