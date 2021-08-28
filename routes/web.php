<?php

namespace Projektgopher\Blog\Routes;

use Illuminate\support\Facades\Route;
use Projektgopher\Blog\Blog;

Route::get('blog/{slug}', function ($slug) {
    $blog = Blog::get($slug);

    return $blog
        ? response(status: 200, content: 'test')
        : response(status: 404);
});
