<?php

namespace Illuminate\Foundation\Console;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class ModelMakeCommand extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'create:model';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if ($this->option('all')) {
            $this->input->setOption('factory', true);
            $this->input->setOption('model', true);
            $this->input->setOption('seed', true);
            $this->input->setOption('migration', true);
            $this->input->setOption('controller', true);
            $this->input->setOption('resource', true);
            $this->input->setOption('service', true);
            $this->input->setOption('repository', true);
            $this->input->setOption('route', true);
            $this->input->setOption('base_repo', true);
            $this->input->setOption('base_service', true);
            $this->input->setOption('i_service', true);
            $this->input->setOption('i_repo', true);
        }

        if ($this->option('factory')) {
            $this->createFactory();
        }

        if ($this->option('base_service')) {
            $this->createBaseService();
        }

        if ($this->option('base_repo')) {
            $this->createBaseRepo();
        }

        if ($this->option('i_service')) {
            $this->createIService();
        }

        if ($this->option('i_repo')) {
            $this->createIRepo();
        }

        if ($this->option('migration')) {
            $this->createMigration();
        }

        if ($this->option('seed')) {
            $this->createSeeder();
        }

        if ($this->option('model')) {
            $this->createModal();
        }

        if ($this->option('service')) {
            $this->createService();
        }

        if ($this->option('repository')) {
            $this->createRepo();
        }

        if ($this->option('controller')) {
            $this->createController();
        }

        if ($this->option('route')) {
            $this->createRoute();
        }

    }

    /**
     * Create a model factory for the model.
     *
     * @return void
     */
    protected function createFactory()
    {
        $factory = Str::studly(class_basename($this->argument('name')));

        $this->call('make:factory', [
            'name' => "{$factory}Factory",
            '--model' => $this->qualifyClass($this->getNameInput()),
        ]);
    }

    /**
     * Create a migration file for the model.
     *
     * @return void
     */
    protected function createMigration()
    {
        $table = Str::snake(Str::pluralStudly(class_basename($this->argument('name'))));
        $name = strtolower(Str::studly(class_basename($this->argument('name'))));
        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }
        $fileList = glob('database/migrations/*');
        $state = '';
        foreach($fileList as $filename){
            if (file_exists(base_path($filename))) {
                if(strpos($filename, $name) !== false){
                    $state = true;
                }
            }
        }
        if ($state) {
            $this->line('<fg=white;bg=red>Migration already created!</>');
        } else {
            $this->call('make:migration', [
                'name' => "create_{$table}_table",
                '--create' => $table,
            ]);
        }
    }

    /**
     * Create a seeder file for the model.
     *
     * @return void
     */
    protected function createSeeder()
    {
        $seeder = Str::studly(class_basename($this->argument('name')));

        $this->call('make:seed', [
            'name' => "{$seeder}Seeder",
        ]);
    }

    /**
     * Create a service for the model.
     *
     * @return void
     */
    protected function createService()
    {
        $service = Str::studly(class_basename($this->argument('name')));
        $service = $service.'Service';
        $this->call('make:service', [
            'name' => ucwords("{$service}"),
        ]);
    }

    /**
     * Create a base service for the model.
     *
     * @return void
     */
    protected function createBaseService()
    {
        $baseService = 'BaseService';
        $this->call('make:base_service', [
            'name' => ucwords("{$baseService}"),
        ]);
    }

    /**
     * Create a base repo for the model.
     *
     * @return void
     */
    protected function createBaseRepo()
    {
        $baseRepository = 'BaseRepo';
        $this->call('make:base_repo', [
            'name' => ucwords("{$baseRepository}"),
        ]);
    }

    /**
     * Create a base repo for the model.
     *
     * @return void
     */
    protected function createIService()
    {
        $iService = 'IService';
        $this->call('make:i_service', [
            'name' => ucwords("{$iService}"),
        ]);
    }

    /**
     * Create a base repo for the model.
     *
     * @return void
     */
    protected function createIRepo()
    {
        $iRepository = 'IRepo';
        $this->call('make:i_repo', [
            'name' => ucwords("{$iRepository}"),
        ]);
    }

    /**
     * Create a repository for the model.
     *
     * @return void
     */
    protected function createRepo()
    {
        $repository = Str::studly(class_basename($this->argument('name')));
        $repository = $repository.'Repo';
        $this->call('make:repository', [
            'name' => "{$repository}",
        ]);
    }

    protected function createController()
    {
        $controller = Str::studly(class_basename($this->argument('name')));
        $controller = $controller.'Controller';
        $this->call('make:controller', array_filter([
            'name'  => "{$controller}"
        ]));
    }

    protected function createModal()
    {
        $model = Str::studly(class_basename($this->argument('name')));

        $this->call('make:model', [
            'name' => "{$model}",
        ]);
    }

    protected function createRoute()
    {
        $route = Str::studly(class_basename($this->argument('name')));
        $this->call('make:route', [
            'name' => "{$route}",
        ]);
        unlink(base_path('app/'. $route . '.php'));

    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        if ($this->option('pivot')) {
           return  base_path('/app/Console/stubs/pivot.model.stub');
        }

        return base_path('/app/Console/stubs/model.stub');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['all', 'a', InputOption::VALUE_NONE, 'Generate a migration, seeder, factory, service, and resource controller for the model'],
            ['controller', 'c', InputOption::VALUE_NONE, 'Create a new controller for the model'],
            ['model', 'd', InputOption::VALUE_NONE, 'Create a new model'],
            ['base_service', 'bs', InputOption::VALUE_NONE, 'Create a new Base Service'],
            ['base_repo', 'br', InputOption::VALUE_NONE, 'Create a new Base Repository'],
            ['i_service', 'is', InputOption::VALUE_NONE, 'Create a new Interface Service'],
            ['i_repo', 'ir', InputOption::VALUE_NONE, 'Create a new Interface Repository'],
            ['service', 'e', InputOption::VALUE_NONE, 'Create a new service for the model'],
            ['route', 'o', InputOption::VALUE_NONE, 'Create a new route for the model'],
            ['repository', 'y', InputOption::VALUE_NONE, 'Create a new repository for the model'],
            ['factory', 'f', InputOption::VALUE_NONE, 'Create a new factory for the model'],
            ['force', null, InputOption::VALUE_NONE, 'Create the class even if the model already exists'],
            ['migration', 'm', InputOption::VALUE_NONE, 'Create a new migration file for the model'],
            ['seed', 's', InputOption::VALUE_NONE, 'Create a new seeder file for the model'],
            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],
            ['resource', 'r', InputOption::VALUE_NONE, 'Indicates if the generated controller should be a resource controller'],
            ['api', null, InputOption::VALUE_NONE, 'Indicates if the generated controller should be an API controller'],
        ];
    }
}
