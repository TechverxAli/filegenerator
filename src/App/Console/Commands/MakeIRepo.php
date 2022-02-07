<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeIRepo extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:i_repo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new interface repository';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'IRepository';

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $baseIClass;

    /**
     * The name of class being generated.
     *
     * @var string
     */
    private $model;

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        if (!$this->argument('name')) {
            throw new InvalidArgumentException("Missing required argument model name");
        }
        $stub = parent::replaceClass($stub, $name);
        $modalName = ucwords($this->argument('name'));
        $this->model = $modalName;
//        $modalName = str_replace('Service', '', $modalName);
        return str_replace('Dummy', $modalName, $stub);
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('/app/Console/stubs/IRepo.stub');
    }

    /**
     * Get the default namespace for the class.
     *
     * @param string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repositories';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the model class.'],
        ];
    }
}


