<?php

namespace Projektgopher\Blog\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class MakeCommandTest extends TestCase
{
    /** @test */
    public function it_has_a_make_command()
    {
        $this->assertTrue(Arr::has(Artisan::all(), 'blog:make'));
    }

    /** @test */
    // public function it_has_an_alias()
    // {
    //     $this->assertTrue(Arr::has(Artisan::all(), 'make:blog'));
    // }

    /** @test */
    public function it_sluggifies_a_title()
    {
        $title = 'Long blog title that has to be sluggified';

        $this->artisan('blog:make')
            ->expectsQuestion('What is the name of your blog post?', $title)
            ->expectsOutput(Str::slug($title));
    }

    /** @test */
    public function it_accepts_a_title_argument()
    {
        $title = 'Long blog title that has to be sluggified';

        $this->artisan("blog:make '{$title}'")
            ->expectsOutput(Str::slug($title));
    }
}
