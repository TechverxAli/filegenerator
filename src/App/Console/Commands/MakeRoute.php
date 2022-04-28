<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Exception\InvalidArgumentException;

class MakeRoute extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:route';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new route';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Route';

    /**
     * Replace the class name for the given stub.
     *
     * @param $stub
     * @param $name
     * @return false|int|string
     */
    protected function replaceClass($stub, $name)
    {
        if (!$this->argument('name')) {
            throw new InvalidArgumentException("Missing required argument model name");
        }
        $route = ucwords(strtolower($this->argument('name')));
        $controllerName = $route.'Controller';
        $routeName = strtolower($this->argument('name'));
        $route="Route::get('/$routeName', [$controllerName::class, '$routeName'])";
        $routeWithName = $route."->name('$routeName');";
        $importClause='use App\Http\Controllers\\'.$controllerName.';';
        $file = 'routes/web.php';
        $fileContent=file_get_contents($file);
        if (strpos($fileContent, $routeWithName) !== false) {
            $this->line('<fg=white;bg=red>Route already created!</>');
        } else {
            $importLocation=strpos($fileContent,  'use');
            if ($importLocation) {
                $fileContent=substr($fileContent, 0, $importLocation).$importClause."\r\n".substr($fileContent, $importLocation)."\n";
            }
            $routeLocation=strpos($fileContent, '*/')+3;
            if ($routeLocation) {
                $fileContent=substr($fileContent, 0, $routeLocation)."\r\n".$routeWithName."\r\n".substr($fileContent, $routeLocation);
            }
        }

        return file_put_contents("routes/web.php", $fileContent);
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('/app/Console/stubs/routes');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'The name of the route class.'],
        ];
    }
}
