<?php

namespace Projektgopher\Blog;

use League\CommonMark\GithubFlavoredMarkdownConverter;
use Illuminate\Support\Facades\File;

class Blog
{
    public static $publishedDirectory = "resources/blogs/published";
    public static $unpublishedDirectory = "resources/blogs/unpublished";

    public static function exists($slug): bool
    {
        return File::exists(SELF::$publishedDirectory . "/{$slug}.md");
    }

    public static function asHtml($slug): string
    {
        $converter = new GithubFlavoredMarkdownConverter(
            [
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
            ]
        );

        return $converter->convertToHtml(
            File::get(SELF::$publishedDirectory . "/{$slug}.md")
        );
    }
}
