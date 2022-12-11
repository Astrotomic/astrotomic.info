<?php

namespace App\Models;

use Carbon\CarbonInterval;
use Github\Client as Github;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Sushi\Sushi;

/**
 * App\Models\Contributor
 *
 * @property string|null $login
 * @property int $id
 * @property string|null $avatar_url
 * @property string|null $html_url
 * @property string|null $name
 * @property string|null $blog
 * @property string|null $location
 * @property string|null $bio
 * @property string|null $twitter_username
 * @property-read bool $is_member
 * @property-read int $total_commits
 * @property-read string|null $twitter_url
 * @property-read string|null $website
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Contributor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contributor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contributor query()
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Contributor extends Model
{
    use Sushi;

    /**
     * @return \Illuminate\Database\Eloquent\Collection<array-key, \App\Models\Package>
     */
    public function packages(): EloquentCollection
    {
        return Package::all()
            ->filter(fn (Package $package) => $package->contributors()->contains($this));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection<array-key, \App\Models\Application>
     */
    public function applications(): EloquentCollection
    {
        return Application::all()
            ->filter(fn (Application $application) => $application->contributors()->contains($this));
    }

    public function getSchema(): array
    {
        return [
            'name' => 'string',
            'login' => 'string',
            'blog' => 'string',
            'twitter_username' => 'string',
            'bio' => 'text',
            'location' => 'string',
            'html_url' => 'string',
            'avatar_url' => 'string',
        ];
    }

    public function getRows(): array
    {
        return Cache::remember("{$this->getTable()}.rows", CarbonInterval::hour(), function (): array {
            return collect()
                ->merge(Package::all()->pluck('contributor_stats'))
                ->merge(Application::all()->pluck('contributor_stats'))
                ->map(fn (Collection $stats) => $stats->keys())
                ->flatten()
                ->unique()
                ->map(fn (string $login) => app(Github::class)->user()->show($login))
                ->reject(fn (array $user) => $user['type'] === 'Bot')
                ->map(fn (array $user) => Arr::only($user, [
                    'id',
                    'name',
                    'login',
                    'blog',
                    'twitter_username',
                    'bio',
                    'location',
                    'html_url',
                    'avatar_url',
                ]))
                ->all();
        });
    }

    public function getTwitterUrlAttribute(): ?string
    {
        return $this->twitter_username ? "https://twitter.com/{$this->twitter_username}" : null;
    }

    public function getWebsiteAttribute(): ?string
    {
        if (empty($this->blog)) {
            return null;
        }

        if (Str::startsWith($this->blog, ['http://', 'https://'])) {
            return $this->blog;
        }

        return Str::start($this->blog, 'https://');
    }

    public function getTotalCommitsAttribute(): int
    {
        return $this->packages()->sum("contributor_stats.{$this->login}")
            + $this->applications()->sum("contributor_stats.{$this->login}");
    }

    public function getIsMemberAttribute(): bool
    {
        return in_array($this->id, [
            6187884, // Gummibeer
            1785686, // dimsav
            38976391, // SarahSibert
        ]);
    }
}
