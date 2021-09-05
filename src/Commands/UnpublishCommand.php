<?php

namespace Projektgopher\Scrawl\Commands;

use Illuminate\Console\Command;

class UnpublishCommand extends Command
{
    public $signature = 'blog:unpublish {title?}';

    public $description = 'move .md file from published to unpublished directory';

    public function handle(): void
    {
    }
}
