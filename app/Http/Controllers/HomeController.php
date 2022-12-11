<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Contributor;
use App\Models\Package;
use App\Models\Sponsor;
use App\Models\Trustee;
use Astrotomic\Ecologi\Ecologi;
use Illuminate\View\View;

class HomeController
{
    public function __invoke(Ecologi $ecologi): View
    {
        $apps = Application::query()
            ->orderByDesc('github_stars')
            ->get();

        $promos = Package::query()
            ->whereIn('name', [
                'astrotomic/laravel-translatable',
                'astrotomic/php-twemoji',
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
            'stats' => [
                'packages' => Package::count(),
                'downloads' => Package::sum('total_downloads'),
                'contributors' => Contributor::count(),
                'commits' => Package::pluck('contributor_stats')->map->sum()->sum()
                    + Application::pluck('contributor_stats')->map->sum()->sum(),
                'stars' => Package::sum('github_stars')
                    + Application::sum('github_stars'),
                'trees' => $ecologi->reporting()->getTrees('astrotomic'),
            ],
            'apps' => $apps,
            'promos' => $promos,
            'packages' => $packages,
            'contributors' => $contributors,
            'sponsors' => $sponsors,
            'trustees' => $trustees,
        ]);
    }
}
