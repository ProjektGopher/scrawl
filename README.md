# Scrawl
## Just get writing.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/projektgopher/laravel-blog.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-blog)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/projektgopher/laravel-blog/run-tests?label=tests)](https://github.com/projektgopher/laravel-blog/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/projektgopher/laravel-blog/Check%20&%20fix%20styling?label=code%20style)](https://github.com/projektgopher/laravel-blog/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/projektgopher/laravel-blog.svg?style=flat-square)](https://packagist.org/packages/projektgopher/laravel-blog)

This is designed to be the lowest barrier to entry markdown file based single user blogging solution for Laravel

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/laravel-blog.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/laravel-blog)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require projektgopher/laravel-blog
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Projektgopher\Blog\BlogServiceProvider" --tag="laravel-blog-config"
```

This is the contents of the published config file:

```php
return [
    // publishedDirectory
    // unpublishedDirectory
    // route group
];
```

## Usage

```bash
php artisan blog:make 'long title that should be sluggified'
```

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
