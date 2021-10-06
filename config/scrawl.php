<?php

// config for Projektgopher/Scrawl

return [

    /**
     * These folders are located in the resources directory. We suggest
     * storing them in a directory named md (markdown) to follow
     * with the conventions of the resources directory.
     */
    "unpublished_directory" => "md/scrawl/unpublished",
    "published_directory" => "md/scrawl/published",
    "blog_directory" => "md/scrawl",

    "author_bio" => "",
    "author_name" => "",
    "author_link" => "",
    "author_photo" => "",
    "author_photo_alt" => "",

    "route_group" => "blog",

    "view" => [
        /**
         * Read the list of driver options below, and
         * choose the option that best suits you.
         */
        "driver" => "standalone",

        /**
         * Use "none" if you'd like to return the data as JSON.
         * Particularly useful for Vue or React based blogs.
         */
        "none" => "",

        /**
         * Use "custom" if you don't have a main layout file
         * but also don't want to use the one provided.
         */
        "custom" => "",

        /**
         * Use "standalone" if you don't have a main layout
         * file. Great for just getting started quickly.
         * You can alawys move to a layout based
         * setup later on.
         */
        "standalone" => "",

        /**
         * Use "x-component" if your views include a blade
         * layout component such as <x-layouts.app />
         */
        "x-component" => [
            "component" => "layouts.app",
        ],

        /**
         * Use "blade-layout" if your views extend a
         * base layout using the @extends method.
         */
        "blade-layout" => [
            "extends" => "layouts.app",
            "section" => "body",
        ],
    ],

];
