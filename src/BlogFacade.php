<?php

namespace Projektgopher\Blog;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Projektgopher\Blog\Blog
 */
class BlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-blog';
    }
}
