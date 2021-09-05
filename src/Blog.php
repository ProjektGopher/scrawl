<?php

namespace Projektgopher\Scrawl;

use Illuminate\Support\Facades\File;
use League\CommonMark\GithubFlavoredMarkdownConverter;

class Blog
{
    public static $publishedDirectory = "resources/blogs/published";
    public static $unpublishedDirectory = "resources/blogs/unpublished";

    public static function isPublished($slug): bool
    {
        return File::exists(self::$publishedDirectory . "/{$slug}.md");
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
            File::get(self::$publishedDirectory . "/{$slug}.md")
        );
    }
}
