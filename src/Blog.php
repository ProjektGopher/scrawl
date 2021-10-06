<?php

namespace Projektgopher\Scrawl;

use Illuminate\Support\Facades\File;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Projektgopher\Scrawl\Exceptions\BlogAlreadyExistsException;
use Projektgopher\Scrawl\Exceptions\BlogNotFoundException;

class Blog
{
    public static function path(?string $path = null): string
    {
        return resource_path(config('scrawl.blog_directory') . ($path ? "/{$path}" : ""));
    }

    public static function published_path(?string $path = null): string
    {
        return resource_path(config('scrawl.published_directory') . ($path ? "/{$path}" : ""));
    }

    public static function unpublished_path(?string $path = null): string
    {
        return resource_path(config('scrawl.unpublished_directory') . ($path ? "/{$path}" : ""));
    }

    public static function isPublished($slug): bool
    {
        return (bool) File::exists(static::published_path("{$slug}.md"));
    }

    public static function isUnpublished($slug): bool
    {
        return (bool) File::exists(static::unpublished_path("{$slug}.md"));
    }

    public static function asHtml($slug): string
    {
        $converter = new GithubFlavoredMarkdownConverter(
            [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            ]
        );

        return (string) $converter->convertToHtml(
            File::get(static::published_path("{$slug}.md"))
        );
    }

    public static function make($slug)
    {
        if (! Blog::createFromStubIfNotExists($slug)) {
            throw new BlogAlreadyExistsException();
        }
    }

    public static function createFromStubIfNotExists($slug): bool
    {
        if (static::isUnpublished($slug)) {
            return false;
        }

        File::ensureDirectoryExists(static::unpublished_path());
        File::put(
            static::unpublished_path("{$slug}.md"),
            // TODO: not sure if I should change how following file is referenced.
            File::get('vendor/projektgopher/scrawl/stubs/blog.md.stub')
        );

        return true;
    }

    public static function publish($slug): void
    {
        File::ensureDirectoryExists(static::published_path());

        if (File::missing(static::unpublished_path("{$slug}.md"))) {
            throw new BlogNotFoundException();
        }

        if (File::exists(static::published_path("{$slug}.md"))) {
            throw new BlogAlreadyExistsException();
        }

        File::move(
            static::unpublished_path("{$slug}.md"),
            static::published_path("{$slug}.md")
        );
    }

    public static function unpublish($slug): void
    {
        File::ensureDirectoryExists(static::unpublished_path());

        if (File::missing(static::published_path("{$slug}.md"))) {
            throw new BlogNotFoundException();
        }

        if (File::exists(static::unpublished_path("{$slug}.md"))) {
            throw new BlogAlreadyExistsException();
        }

        File::move(
            static::published_path("{$slug}.md"),
            static::unpublished_path("{$slug}.md")
        );
    }
}
