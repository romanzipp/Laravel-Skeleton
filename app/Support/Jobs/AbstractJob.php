<?php

namespace Support\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

abstract class AbstractJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public int $tries = 1;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public int $backoff = 30;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public int $timeout = 0;

    abstract public function handle();

    protected function withMemoryData(): void
    {
        if ( ! method_exists($this, 'queueData')) {
            return;
        }

        $this->queueData([
            '_memory' => $this->getMemoryUsage(),
        ], true);
    }

    protected function withServerName(): void
    {
        if ( ! method_exists($this, 'queueData')) {
            return;
        }

        $this->queueData([
            '_server' => $this->getServerName(),
        ], true);
    }

    protected function getServerName()
    {
        return gethostname();
    }

    protected function getMemoryUsage(): array
    {
        return [
            'current' => memory_get_usage(),
            'peak' => memory_get_peak_usage(),
        ];
    }
}
