<?php

namespace App\Http\Controllers;

use App\Models\Contributor;
use App\Models\Package;
use App\Models\Sponsor;
use App\Models\Trustee;
use Illuminate\View\View;

class HomeController
{
    public function __invoke(): View
    {
        $promos = Package::query()
            ->whereIn('name', [
                'astrotomic/laravel-translatable',
                // ToDo: 'astrotomic/tmdb-sdk',
            ])
            ->orderByDesc('total_downloads')
            ->get();

        $packages = Package::query()
            ->whereNotIn('name', $promos->pluck('name'))
            ->orderBy('is_abandoned')
            ->orderByDesc('total_downloads')
            ->get();

        $contributors = Contributor::all()
            ->sortByDesc('total_commits');

        $sponsors = Sponsor::query()
            ->orderByRaw('LOWER(login)')
            ->get();

        $trustees = Trustee::query()
            ->orderByRaw('LOWER(name)')
            ->get();

        return view('pages.home', [
            'promos' => $promos,
            'packages' => $packages,
            'contributors' => $contributors,
            'sponsors' => $sponsors,
            'trustees' => $trustees,
        ]);
    }
}
