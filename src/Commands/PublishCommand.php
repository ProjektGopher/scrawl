<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    public $signature = 'blog:publish {title?}';

    public $description = 'move .md file from unpublished to published directory';

    public function handle(): void
    {

    }
}
