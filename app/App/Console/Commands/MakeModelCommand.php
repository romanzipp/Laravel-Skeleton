<?php

namespace App\Console\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

final class MakeModelCommand extends AbstractGeneratorCommand
{
    protected $name = 'make:model';

    protected $description = 'Create a new Eloquent model class (with domain)';

    protected $type = 'Model';

    public function handle()
    {
        parent::handle();

        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('seed', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('resource', true);
            $this->input->setOption('repository', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('resource')) {
            $this->createResource();
        }

        if ($this->option('repository')) {
            $this->createRepository();
        }
    }

    public function createFactory()
    {
        $factory = Str::studly($this->argument('name'));

        $this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
            '--domain' => $this->getDomain(),
        ]);
    }

    private function createResource()
    {
        $factory = Str::studly($this->argument('name'));

        $this->call('make:resource', [
            'name' => "{$factory}Resource",
            '--model' => $this->qualifyClass($this->getNameInput()),
            '--domain' => $this->getDomain(),
        ]);
    }

    private function createRepository()
    {
        $factory = Str::studly($this->argument('name'));

        $this->call('make:repository', [
            'name' => "{$factory}Repository",
            '--resource' => "{$factory}Repository",
            '--model' => $this->qualifyClass($this->getNameInput()),
            '--domain' => $this->getDomain(),
        ]);
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        // Repalce {{ tableConstant }}
        $stub = str_replace('{{ tableConstant }}', $this->getTableName($name, true), $stub);

        return $this
            ->replaceNamespace($stub, $name)
            ->replaceClass($stub, $name);
    }

    protected function getTableName($name, bool $codeSafe): string
    {
        $table = strtolower($this->getDomain()) . '-' . Str::plural(Str::snake(strtolower(Arr::last(explode('\\', $name)))));

        if ( ! $codeSafe) {
            return $table;
        }

        return strtoupper(str_replace('-', '_', $table));
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return sprintf('%s\\%s', $rootNamespace, 'Models');
    }

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/model.stub');
    }

    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, and resource controller for the model'],
            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model'],
            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists'],
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model'],
            ['seed', 's', InputOption::VALUE_NONE, 'Create a new seeder file for the model'],
            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],
            // ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
            // ['api', null, InputOption::VALUE_NONE, 'Indicates if the generated controller should be an API controller'],
            // New
            ['domain', 'd', InputOption::VALUE_REQUIRED, 'Specify the domain'],
            ['repository', null, InputOption::VALUE_NONE, 'Creates a new repository for the model'],
            ['resource', null, InputOption::VALUE_NONE, 'Creates a new resource for the model'],
        ];
    }
}
