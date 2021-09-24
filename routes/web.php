<?php

namespace Projektgopher\Scrawl\Routes;

use Illuminate\Support\Facades\Route;
use Projektgopher\Scrawl\Blog;
use Projektgopher\Scrawl\Exceptions\NotImplementedException;
use Symfony\Component\HttpKernel\Exception\HttpException;

Route::get('blog/{slug}', function ($slug) {
    if (! Blog::isPublished($slug)) {
        // abort(404, 'We couldn\'t find this post.');
        // throw new HttpException(404, 'We couldn\'t find this post.');
        return response(status: 404, content: 'We couldn\'t find this post.');
    }

    if (config('scrawl.view.driver') === 'standalone') {
        // return response(status: 200, content: Blog::asHtml($slug));
        return view('scrawl::standalone', ['body' => Blog::asHtml($slug)]);
    }

    // "none" => "",
    // "custom" => "",
    // "standalone" => "",
    // "x-component" => [
    //     "component" => "layouts.app",
    // ],
    // "blade-layout" => [
    //     "extends" => "layouts.app",
    //     "section" => "body",
    // ],

    throw new NotImplementedException;
});
