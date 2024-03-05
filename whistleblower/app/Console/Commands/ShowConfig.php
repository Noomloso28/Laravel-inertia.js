<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ShowConfig extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'config:show {key? : Only get this one key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the config';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($specifiedKey = $this->argument('key')) {
            $loop = [$specifiedKey => config($specifiedKey)];
        } else {
            $loop = config()->all();
        }

        foreach ($loop as $key => $config) {
            $this->info($key);
            dump($config);
            $this->newLine();
        }

        return Command::SUCCESS;
    }
}
