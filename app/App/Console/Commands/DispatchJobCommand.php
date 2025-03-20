<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

final class DispatchJobCommand extends Command
{
    protected $signature = 'dispatch {job} {--N|now}';

    public function handle()
    {
        $jobClass = $this->argument('job');
        $resvoledClass = null;

        $classes = require base_path('vendor/composer/autoload_classmap.php');
        foreach ($classes as $className => $path) {
            /** @phpstan-ignore-next-line */
            $baseClassName = ($parts = explode('\\', $className))[count($parts) - 1];

            if ($baseClassName !== $jobClass) {
                continue;
            }

            if (null !== $resvoledClass) {
                $this->error('Can not resolve class name uniquely');

                return;
            }

            $resvoledClass = $className;
        }

        if (null === $resvoledClass) {
            $this->error('Can not resolve class name');

            if ($this->confirm('Run "composer dump-autoload"?', true)) {
                app('composer')->dumpAutoloads();
                $this->handle();
            }

            return;
        }

        if ( ! class_exists($resvoledClass)) {
            $this->error("Job class '$resvoledClass' not found");

            return;
        }

        $job = new $resvoledClass();

        if ($this->option('now')) {
            $this->info("Executing '$resvoledClass' ...");
            dispatch_sync($job);
            $this->info('Executed');
        } else {
            dispatch($job);
            $this->info("Dispatched '$resvoledClass'");
        }
    }
}
