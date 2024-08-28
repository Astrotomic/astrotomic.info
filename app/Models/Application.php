<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Sushi\Sushi;

/**
 * App\Models\Application
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $repository
 * @property string|null $homepage
 * @property string|null $language
 * @property int|null $github_stars
 * @property \Illuminate\Support\Collection|null $contributor_stats
 * @property-read string|null $color
 * @property-read string|null $image
 * @property-read string $label
 * @property-read string|null $summary
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Application newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Application query()
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Application extends Model
{
    use Sushi;

    protected $casts = [
        'github_stars' => 'int',
        'contributor_stats' => 'collection',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Collection<array-key, \App\Models\Contributor>
     */
    public function contributors(): EloquentCollection
    {
        return Contributor::query()
            ->whereIn('login', $this->contributor_stats->keys())
            ->get();
    }

    public function getSchema(): array
    {
        return [
            'name' => 'string',
            'description' => 'text',
            'repository' => 'string',
            'language' => 'string',
            'github_stars' => 'unsignedInteger',
            'contributor_stats' => 'json',
        ];
    }

    public function getRows(): array
    {
        return Cache::get("{$this->getTable()}.rows", []);
    }

    public function getLabelAttribute(): string
    {
        return match ($this->name) {
            'Astrotomic/git-author' => 'GitHub Author',
            'Astrotomic/dnd-converter' => 'D&D Unit Converter',
        };
    }

    public function getSummaryAttribute(): ?string
    {
        return data_get(get_meta_tags($this->homepage), 'description');
    }

    public function getImageAttribute(): ?string
    {
        return match ($this->name) {
            'Astrotomic/git-author' => 'resources/img/github-author.png',
            'Astrotomic/dnd-converter' => 'resources/img/dnd-unit-converter.png',
        };
    }

    public function getColorAttribute(): ?string
    {
        return match ($this->name) {
            'Astrotomic/git-author' => '#28A745',
            'Astrotomic/dnd-converter' => '#FF7A81',
        };
    }

    public function getDomainAttribute(): string
    {
        return parse_url($this->homepage, PHP_URL_HOST);
    }
}
