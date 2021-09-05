<?php

namespace Projektgopher\Scrawl\Routes;

use Illuminate\Support\Facades\Route;
use Projektgopher\Scrawl\Blog;

Route::get('blog/{slug}', function ($slug) {

    return Blog::isPublished($slug)
        ? response(status: 200, content: Blog::asHtml($slug))
        : response(status: 404);
});
