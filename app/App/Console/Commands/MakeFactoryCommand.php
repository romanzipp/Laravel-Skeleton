<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

final class MakeFactoryCommand extends AbstractGeneratorCommand
{
    protected $name = 'make:factory';

    protected $description = 'Create a new model factory class (with domain)';

    protected $type = 'Factory';

    public function handle(): ?bool
    {
        return parent::handle();
    }

    protected function buildClass($name)
    {
        $factory = class_basename(Str::ucfirst(str_replace('Factory', '', $name)));

        $namespaceModel = $this->option('model')
            ? $this->qualifyModel($this->option('model'))
            : $this->qualifyModel($this->guessModelName($name));

        $model = class_basename($namespaceModel);

        if (Str::startsWith($namespaceModel, $this->rootNamespace() . 'Models')) {
            $namespace = Str::beforeLast('Database\\Factories\\' . Str::after($namespaceModel, $this->rootNamespace() . 'Models\\'), '\\');
        } else {
            $namespace = 'Database\\Factories';
        }

        $replace = [
            '{{ factoryNamespace }}' => $namespace,
            '{{ namespacedModel }}' => $namespaceModel,
            '{{ model }}' => $model,
            '{{ modelFqdn }}' => $namespaceModel,
            '{{ factory }}' => $factory,
        ];

        return str_replace(
            array_keys($replace), array_values($replace), parent::buildClass($name)
        );
    }

    protected function guessModelName($name)
    {
        // Database\Factories\Test\ProjectFactory
        if (Str::endsWith($name, 'Factory')) {
            // Database\Factories\Test\Project
            $name = substr($name, 0, -7);
        }

        // Project
        $modelName = $this->qualifyModel(
            Str::after($name, $this->rootNamespace() . '\\' . $this->getDomain())
        );

        if (class_exists($modelName)) {
            return $modelName;
        }

        return $this->rootNamespace() . 'Model';
    }

    protected function getPath($name)
    {
        $name = (string) Str::of($name)->replaceFirst($this->rootNamespace(), '')->finish('Factory');

        return $this->laravel->databasePath() . '/factories/' . str_replace('\\', '/', $name) . '.php';
    }

    protected function rootNamespace()
    {
        return sprintf('Database\\Factories');
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return sprintf('%s\\%s', $rootNamespace, $this->getDomain());
    }

    protected function getStub()
    {
        return $this->resolveStubPath('/stubs/factory.stub');
    }

    protected function getOptions()
    {
        return [
            ['model', null, InputOption::VALUE_REQUIRED, 'The eloquent model'],
            ['domain', 'd', InputOption::VALUE_REQUIRED, 'Specify the domain'],
        ];
    }
}
