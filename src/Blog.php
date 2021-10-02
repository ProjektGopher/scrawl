<?php

namespace Projektgopher\Scrawl;

use Illuminate\Support\Facades\File;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Projektgopher\Scrawl\Exceptions\BlogAlreadyExistsException;
use Projektgopher\Scrawl\Exceptions\BlogNotFoundException;

class Blog
{
    public static $blogDirectory = "resources/blogs";
    public static $publishedDirectory = "resources/blogs/published";
    public static $unpublishedDirectory = "resources/blogs/unpublished";

    public static function isPublished($slug): bool
    {
        return File::exists(base_path(self::$publishedDirectory . "/{$slug}.md"));
    }

    public static function isUnpublished($slug): bool
    {
        return (bool) File::exists(base_path(self::$unpublishedDirectory . "/{$slug}.md"));
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
            File::get(base_path(self::$publishedDirectory . "/{$slug}.md"))
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
        if (self::isUnpublished($slug)) {
            return false;
        }

        File::ensureDirectoryExists(self::$unpublishedDirectory);
        File::put(
            self::$unpublishedDirectory . "/{$slug}.md",
            // TODO: not sure if I should change how following file is referenced.
            File::get('vendor/projektgopher/scrawl/stubs/blog.md.stub')
        );

        return true;
    }

    public static function publish($slug): void
    {
        File::ensureDirectoryExists(self::$publishedDirectory);

        if (File::missing(self::$unpublishedDirectory . "/{$slug}.md")) {
            throw new BlogNotFoundException();
        }

        if (File::exists(self::$publishedDirectory . "/{$slug}.md")) {
            throw new BlogAlreadyExistsException();
        }

        File::move(
            Blog::$unpublishedDirectory . "/{$slug}.md",
            Blog::$publishedDirectory . "/{$slug}.md"
        );
    }

    public static function unpublish($slug): void
    {
        File::ensureDirectoryExists(self::$unpublishedDirectory);

        if (File::missing(self::$publishedDirectory . "/{$slug}.md")) {
            throw new BlogNotFoundException();
        }

        if (File::exists(self::$unpublishedDirectory . "/{$slug}.md")) {
            throw new BlogAlreadyExistsException();
        }

        File::move(
            Blog::$publishedDirectory . "/{$slug}.md",
            Blog::$unpublishedDirectory . "/{$slug}.md"
        );
    }
}
