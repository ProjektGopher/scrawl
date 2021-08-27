<?php

namespace Projektgopher\Blog\Commands;

use Illuminate\Console\Command;

class BlogCommand extends Command
{
    public $signature = 'laravel-blog';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
