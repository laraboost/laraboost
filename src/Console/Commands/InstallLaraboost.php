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
    protected $signature = 'boost';

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
        $bar = $this->output->createProgressBar(count($directories));
        $this->comment('Installing Laraboost...');
        $bar->start();
        collect($directories)->each(function ($dir) use ($bar) {
            $path = base_path($dir);
            if (!is_dir($path)) {
                mkdir($path);
            }
            $bar->advance();
        });
        $bar->finish();
        $this->line('');
        $this->info('Installation Complete...');
    }
}
