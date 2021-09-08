<?php

namespace App\Console\Commands;

use Symfony\Component\Console\Input\InputOption;

final class MakeRepositoryCommand extends AbstractGeneratorCommand
{
    protected $name = 'make:repository';

    protected $description = 'Create a new model repository class (with domain)';

    protected $type = 'Repository';

    public function handle()
    {
        parent::handle();
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        // Replace model fqdn
        $stub = str_replace('{{ modelFqdn }}', $this->option('model'), $stub);

        // Replace resource fqdn
        $stub = str_replace('{{ resourceFqdn }}', str_replace('\\Models\\', '\\Http\\Resources\\', $this->option('model')) . 'Resource', $stub);

        return $this
            ->replaceNamespace($stub, $name)
            ->replaceClass($stub, $name);
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return sprintf('%s\\%s', $rootNamespace, 'Repositories');
    }

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/repository.stub');
    }

    protected function getOptions()
    {
        return [
            ['model', null, InputOption::VALUE_REQUIRED, 'The eloquent model'],
            ['resource', null, InputOption::VALUE_REQUIRED, 'The model resource'],
            ['domain', 'd', InputOption::VALUE_REQUIRED, 'Specify the domain'],
        ];
    }
}
