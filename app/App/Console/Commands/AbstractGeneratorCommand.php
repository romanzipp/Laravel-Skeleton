<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

abstract class AbstractGeneratorCommand extends GeneratorCommand
{
    protected string $domain;

    public function handle(): ?bool
    {
        $this->domain = $this->ensureDomainOption();

        return parent::handle();
    }

    protected function getDomain(): ?string
    {
        if ( ! isset($this->domain)) {
            throw new \LogicException('Can not access domain');
        }

        return $this->domain;
    }

    protected function qualifyModel(string $model)
    {
        $model = ltrim($model, '\\/');

        $model = str_replace('/', '\\', $model);

        $rootNamespace = $this->domainNamespace() . '\\';

        if (Str::startsWith($model, $rootNamespace)) {
            return $model;
        }

        return $rootNamespace . 'Models\\' . $model;
    }

    protected function rootNamespace()
    {
        return sprintf('Domain\\%s', $this->getDomain());
    }

    public function domainNamespace()
    {
        return sprintf('Domain\\%s', $this->getDomain());
    }

    protected function getPath($name)
    {
        // Laravel path: /project/app/App -> /project/app
        $base = Str::replaceLast('/App', '', $this->laravel['path']);
        $path = str_replace('\\', '/', $name);

        return sprintf('%s/%s.php', $base, $path);
    }

    public function ensureDomainOption(): string
    {
        if ( ! $domain = $this->option('domain')) {
            throw new \InvalidArgumentException('The --domain option must be specified');
        }

        return $domain;
    }

    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }
}
