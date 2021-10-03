<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

final class MakeResourceCommand extends AbstractGeneratorCommand
{
    protected $name = 'make:resource';

    protected $description = 'Create a new model resource class (with domain)';

    protected $type = 'Resource';

    public function handle(): ?bool
    {
        return parent::handle();
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        if ($this->option('model')) {
            $modelShort = Arr::last(explode('\\', $this->option('model')));

            // Replace model var
            $stub = str_replace('{{ modelVariable }}', Str::camel($modelShort), $stub);

            // Replace model fqdn
            $stub = str_replace('{{ modelFqdn }}', $this->option('model'), $stub);
        }

        return $this
            ->replaceNamespace($stub, $name)
            ->replaceClass($stub, $name);
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return sprintf('%s\\%s', $rootNamespace, 'Http\\Resources');
    }

    protected function getStub()
    {
        return $this->option('model')
            ? $this->resolveStubPath('/stubs/resource.stub')
            : $this->resolveStubPath('/stubs/resource.plain.stub');
    }

    protected function getOptions()
    {
        return [
            ['model', null, InputOption::VALUE_REQUIRED, 'The eloquent model'],
            ['domain', 'd', InputOption::VALUE_REQUIRED, 'Specify the domain'],
        ];
    }
}
