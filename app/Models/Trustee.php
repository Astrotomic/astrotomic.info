<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Sushi\Sushi;

/**
 * App\Models\Trustee
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $location
 * @property string|null $website
 * @property-read string $image
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Trustee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trustee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Trustee query()
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Trustee extends Model
{
    use Sushi;

    public function getSchema(): array
    {
        return [
            'name' => 'string',
            'location' => 'string',
            'website' => 'string',
        ];
    }

    public function getRows(): array
    {
        return [
            [
                'name' => 'Alle Wetter',
                'location' => 'Kiel, Germany',
                'website' => 'https://aw-studio.de',
            ],
            [
                'name' => 'Litstack',
                'location' => 'Kiel, Germany',
                'website' => 'http://litstack.io',
            ],
            [
                'name' => 'arbiträr',
                'location' => 'Flensburg, Germany',
                'website' => 'https://arbitraer.de',
            ],
            [
                'name' => 'visuellverstehen',
                'location' => 'Flensburg, Germany',
                'website' => 'https://www.visuellverstehen.de',
            ],
            [
                'name' => 'Area 17',
                'location' => 'Paris, France',
                'website' => 'https://area17.com',
            ],
            [
                'name' => 'Twill',
                'location' => 'Paris, France',
                'website' => 'https://twillcms.com',
            ],
            [
                'name' => 'Cell 5',
                'location' => 'London, England',
                'website' => 'https://www.cell5.co.uk',
            ],
            [
                'name' => 'Webdesign7',
                'location' => 'London, England',
                'website' => 'https://www.webdesign7.co.uk',
            ],
            [
                'name' => 'Code for Romania',
                'location' => 'Bucharest, Romania',
                'website' => 'https://code4.ro',
            ],
            [
                'name' => 'Each + Every',
                'location' => 'Kent, Ohio, USA',
                'website' => 'https://eachevery.com',
            ],
            [
                'name' => 'Art Institute of Chicago',
                'location' => 'Chicago, Illinois, USA',
                'website' => 'https://artic.edu',
            ],
            [
                'name' => 'Elbgoods',
                'location' => 'Hamburg, Germany',
                'website' => 'https://elbgoods.de',
            ],
            [
                'name' => 'eXolnet',
                'location' => 'Montreal, Canada',
                'website' => 'https://exolnet.com',
            ],
            [
                'name' => 'Frischepost',
                'location' => 'Hamburg, Germany',
                'website' => 'https://frischepost.de',
            ],
            [
                'name' => 'Kraenk Visuell',
                'location' => 'Darmstadt, Germany',
                'website' => 'https://kraenk.de',
            ],
            [
                'name' => 'Letmotiv',
                'location' => 'Lyon, France',
                'website' => 'https://letmotiv.io',
            ],
            [
                'name' => 'madnest',
                'location' => 'Olomouc, Czech Republic',
                'website' => 'https://madne.st',
            ],
            [
                'name' => 'Mevisoft',
                'location' => 'Callao, Peru',
                'website' => 'https://mevisoft.com',
            ],
            [
                'name' => 'Sanjab',
                'location' => 'Amol, Iran',
                'website' => 'https://sanjabteam.github.io',
            ],
            [
                'name' => 'SWIS',
                'location' => 'Leiden, Netherlands',
                'website' => 'https://swis.nl',
            ],
            [
                'name' => 'Think Tomorrow',
                'location' => 'Herentals, Belgium',
                'website' => 'https://thinktomorrow.be',
            ],
            [
                'name' => 'Webkul Software',
                'location' => 'Noida, India',
                'website' => 'https://webkul.com',
            ],
            [
                'name' => 'UnoPim',
                'location' => 'Noida, India',
                'website' => 'https://unopim.com',
            ],
            [
                'name' => 'Bagisto',
                'location' => 'Noida, India',
                'website' => 'https://bagisto.com',
            ],
            [
                'name' => 'Hexide Digital',
                'location' => 'Khmelnytskyi, Ukraine',
                'website' => 'https://hexide-digital.com',
            ],
            [
                'name' => 'INDEXIMSTUDIO',
                'location' => 'Ukraine',
                'website' => 'https://indeximstudio.com',
            ],
            [
                'name' => 'TecnoDesign',
                'location' => 'Ibagué, Colombia',
                'website' => 'https://www.tecnodesign.com.co',
            ],
            [
                'name' => 'Ytrade Group AB',
                'location' => 'Stockholm, Sweden',
                'website' => 'https://www.yaytrade.com',
            ],
            [
                'name' => 'Soluzione Software srl',
                'location' => 'Coriano, Italy',
                'website' => 'https://www.soluzionesoftware.com',
            ],
            [
                'name' => 'Sindria inc.',
                'location' => 'Italy',
                'website' => 'https://sindria.org',
            ],
            [
                'name' => 'Ampeco',
                'location' => 'Hamburg, Germany',
                'website' => 'https://www.ampeco.com',
            ],
            [
                'name' => 'IMTALabs',
                'location' => '? ? ?',
                'website' => 'https://imtalabs.tech',
            ],
            [
                'name' => 'Marketopia',
                'location' => 'Alexandria, Egypt',
                'website' => 'https://marketopiateam.com',
            ],
            [
                'name' => 'Daraya Software Solutions',
                'location' => 'Bogor, Indonesia',
                'website' => 'https://darayastr.my.id',
            ],
        ];
    }

    public function getImageAttribute(): string
    {
        $slug = Str::slug($this->name);

        return "resources/img/trustee/{$slug}.png";
    }
}
