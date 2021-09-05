<?php

namespace Projektgopher\Blog\Routes;

use Illuminate\support\Facades\Route;
use Projektgopher\Blog\Blog;

Route::get('blog/{slug}', function ($slug) {

    return Blog::published($slug)
        ? response(status: 200, content: Blog::asHtml($slug))
        : response(status: 404);
});
