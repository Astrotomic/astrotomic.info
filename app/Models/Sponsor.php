<?php

namespace App\Models;

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
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Sponsor extends Model
{
    use Sushi;

    protected $table = 'sponsors';

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
        return Cache::get("{$this->getTable()}.rows", []);
    }

    public function getHtmlUrlAttribute(): string
    {
        return "https://github.com/{$this->login}";
    }
}
