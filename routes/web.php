<?php

namespace Projektgopher\Blog\Routes;

use Illuminate\Support\Facades\Route;
use Projektgopher\Blog\Blog;

Route::get('blog/{slug}', function ($slug) {

    return Blog::isPublished($slug)
        ? response(status: 200, content: Blog::asHtml($slug))
        : response(status: 404);
});
