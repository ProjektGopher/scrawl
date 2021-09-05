<?php

namespace Projektgopher\Blog;

use Illuminate\Support\Facades\File;

class Blog
{
    public static function exists($slug): bool
    {
        return File::exists("resources/blogs/published/{$slug}.md");
    }
}
