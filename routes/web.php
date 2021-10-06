<?php

namespace Projektgopher\Scrawl\Routes;

use Illuminate\Support\Facades\Route;
use Projektgopher\Scrawl\Blog;
use Projektgopher\Scrawl\Exceptions\NotImplementedException;

Route::get('blog/{slug}', function ($slug) {
    if (! Blog::isPublished($slug)) {
        abort(404, 'We couldn\'t find this post.');
    }

    if (config('scrawl.view.driver') === 'standalone') {
        return view('scrawl::standalone', ['body' => Blog::asHtml($slug)]);
    }

    // "none" => "", // return json
    // "custom" => "",
    // "x-component" => [
    //     "component" => "layouts.app",
    // ],
    // "blade-layout" => [
    //     "extends" => "layouts.app",
    //     "section" => "body",
    // ],

    throw new NotImplementedException;
});
