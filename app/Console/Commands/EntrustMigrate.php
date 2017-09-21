<?php

namespace App\Console\Commands;

use Zizaco\Entrust\MigrationCommand;

class EntrustMigrate extends MigrationCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'entrust-fix:migration';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->fire();
    }
}
