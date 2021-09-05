<?php

namespace Projektgopher\Scrawl;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Projektgopher\Scrawl\Blog
 */
class BlogFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'scrawl';
    }
}
