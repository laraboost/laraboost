<?php

namespace Laraboost\Console\Commands;

use Illuminate\Console\Command;

class InstallLaraboost extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'laraboost:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Laraboost';

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
     * @return mixed
     */
    public function handle()
    {
        $directories = [
            '.laraboost',
            '.laraboost/models',
        ];

        collect($directories)->each(function ($dir) {
            $path = base_path($dir);
            if (!is_dir($path)) {
                mkdir($path);
            }
        });
    }
}
