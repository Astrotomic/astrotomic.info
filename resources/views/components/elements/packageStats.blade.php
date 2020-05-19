<div class="mb-2 divided">
    <span>
        <icon icon="fa-code" icon-style="fas" class="opacity-75" />
        {{ $package['language'] }}
    </span>
    <span>
        <icon icon="fa-star" icon-style="fas" class="opacity-75" />
        {{ number_format($package['github_stars'], 0, '', ' ') }}
    </span>
    <span>
        <icon icon="fa-download" icon-style="fas" class="opacity-75" />
        {{ number_format($package['downloads']['total'], 0, '', ' ') }}
    </span>
    <span>
        <icon icon="fa-link" icon-style="fas" class="opacity-75" />
        {{ $package['dependents'] }}
    </span>
    <span>
        <icon icon="fa-user" icon-style="fas" class="opacity-75" />
        {{ number_format(count(data_get($github, $package['name'].'.contributors', [])), 0, '', ' ') }}
    </span>
    @php($version = array_reduce(array_map(fn($v) => str_replace('v', '', $v), array_filter(array_keys($package['versions']), fn($v) => !\Illuminate\Support\Str::contains($v, 'dev'))), fn ($c, $v) => version_compare($c, $v, '>') ? $c : $v))
    <span>
        <icon icon="fa-tag" icon-style="fas" class="opacity-75" />
        {{ $version ?? 'dev-master' }}
    </span>
</div>
