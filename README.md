[<img src="https://raw.githubusercontent.com/ProjektGopher/scrawl/main/resources/img/scrawl.svg" width="1024px" />](https://scrawl.projektgopher.com/?ref=github)

verb. To write in a hurried or careless way.

### Just get writing.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/projektgopher/scrawl.svg?style=flat-square)](https://packagist.org/packages/projektgopher/scrawl)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/projektgopher/scrawl/run-tests?label=tests)](https://github.com/projektgopher/scrawl/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/projektgopher/scrawl/Check%20&%20fix%20styling?label=code%20style)](https://github.com/projektgopher/scrawl/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/projektgopher/scrawl.svg?style=flat-square)](https://packagist.org/packages/projektgopher/scrawl)

Scrawl is designed to be the lowest friction markdown file based single user blogging solution for Laravel

## Documentation

For the full documentation, visit the [Scrawl home page](https://scrawl.projektgopher.com/?ref=github).

## Installation

You can install the package via composer:

```bash
composer require projektgopher/scrawl
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Projektgopher\Scrawl\BlogServiceProvider" --tag="scrawl-config"
```

This is the contents of the published config file:

```php
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

```

## Usage

Scrawl is desgined to be used on the CLI. It will automatically
register the blog routes, and requires no database as this
package is file based, and meant to have your content
comitted to the project. Only posts saved in the
'published' directory will be publicly accessible.

```bash
php artisan blog:make 'long title that should be sluggified'
```
This command will ensure that the unpublished directory exists,
copy the .md blog post stub into the 'unpublished' directory
with a sluggified title.

Now you can just get into writing your post in github flavored
markdown without worrying about all the details.


```bash
php artisan blog:publish 'name of blog you would like to move to the published directory'
```

```bash
php artisan blog:unpublish 'name of the blog you should not have published yet'
```

## Testing

```bash
vendor/bin/phpunit --testdox
```

## Support us

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Len Woodward](https://github.com/ProjektGopher)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
