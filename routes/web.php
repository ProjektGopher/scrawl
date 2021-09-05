<?php

namespace Projektgopher\Blog\Routes;

use League\CommonMark\GithubFlavoredMarkdownConverter;
use Illuminate\support\Facades\Route;
use Illuminate\Support\Facades\File;
use Projektgopher\Blog\Blog;

Route::get('blog/{slug}', function ($slug) {

    $converter = new GithubFlavoredMarkdownConverter([
        'html_input' => 'strip',
        'allow_unsafe_links' => false,
    ]);

    return Blog::exists($slug)
        ? response(status: 200, content: $converter->convertToHtml(File::get("resources/blogs/published/{$slug}.md")))
        : response(status: 404);
});
