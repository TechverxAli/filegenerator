<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Artisan;

class SingleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'create:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make all users premium Users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param $modalName
     * @return int
     */
    public function handle($modalName)
    {
        $this->model = $modalName;
        Artisan::command('make:repository');
        Artisan::command('make:service').$modalName;
        return 0;
    }
}
