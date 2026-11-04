<?php

namespace App\Support;

use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\MarkdownConverter;

/**
 * Posts em resources/content/blog/{slug}.md com front matter YAML:
 * title, date, summary, cover (caminho em /public).
 */
class Blog
{
    // ponytail: lê e converte todos os .md a cada request; adicione cache quando houver muitos posts.
    public static function all(): Collection
    {
        return collect(glob(resource_path('content/blog/*.md')))
            ->map(fn (string $path) => self::parse($path))
            ->sortByDesc('date')
            ->values();
    }

    public static function find(string $slug): ?object
    {
        $path = resource_path("content/blog/{$slug}.md");

        return preg_match('/^[a-z0-9-]+$/', $slug) && is_file($path) ? self::parse($path) : null;
    }

    private static function parse(string $path): object
    {
        $environment = new Environment;
        $environment->addExtension(new CommonMarkCoreExtension);
        $environment->addExtension(new FrontMatterExtension);

        $result = (new MarkdownConverter($environment))->convert(file_get_contents($path));
        $meta = $result instanceof RenderedContentWithFrontMatter ? $result->getFrontMatter() : [];
        $date = $meta['date'] ?? filemtime($path);

        return (object) [
            'slug' => basename($path, '.md'),
            'title' => $meta['title'] ?? basename($path, '.md'),
            'summary' => $meta['summary'] ?? '',
            'cover' => $meta['cover'] ?? null,
            'date' => is_int($date) ? Carbon::createFromTimestamp($date) : Carbon::parse($date),
            'html' => $result->getContent(),
        ];
    }
}
