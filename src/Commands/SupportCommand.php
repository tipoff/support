<?php

namespace Tipoff\Support\Commands;

use Illuminate\Console\Command;

class SupportCommand extends Command
{
    public $signature = 'support';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
