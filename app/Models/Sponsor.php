<?php

namespace App\Models;

use Astrotomic\GithubSponsors\Facades\GithubSponsors;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Sushi\Sushi;

/**
 * App\Models\Sponsor
 *
 * @property int $id
 * @property string|null $login
 * @property string|null $name
 * @property string|null $location
 * @property string|null $avatar_url
 * @property-read string $html_url
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sponsor query()
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sponsor extends Model
{
    use Sushi;

    public function getSchema(): array
    {
        return [
            'name' => 'string',
            'login' => 'string',
            'location' => 'string',
            'avatar_url' => 'string',
        ];
    }

    public function getRows(): array
    {
        return Cache::remember("{$this->getTable()}.rows", CarbonInterval::hour(), function (): array {
            return GithubSponsors::viewer()
                ->sponsors(fields: ['login', 'avatarUrl', 'location', 'name'])
                ->map(fn (array $user) => [
                    'login' => $user['login'],
                    'name' => $user['name'],
                    'location' => $user['location'],
                    'avatar_url' => $user['avatarUrl'],
                ])
                ->all();
        });
    }

    public function getHtmlUrlAttribute(): string
    {
        return "https://github.com/{$this->login}";
    }
}
