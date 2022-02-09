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
     * The name of class being generated.
     *
     * @var string
     */
    private $route;

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
        $route = ucwords(strtolower($this->argument('name')));
        $this->route = $route;
        $routename = ucwords(strtolower($this->argument('name'))).'Controller';
        $routeurl = strtolower($this->argument('name'));
        $data="Route::get('/$routeurl', [$routename::class, '$routeurl'])";
        $data3 = $data."->name('$routeurl');";
        $data2='use App\Http\Controllers\\'.$routename.';';
        $filecontent=file_get_contents('routes/web.php');
        $routefile=strpos($filecontent, '//My Routes');
        $routefile2=strpos($filecontent, '/*');
        $filecontent=substr($filecontent, 0, $routefile)."\r\n".$data3."\r\n".substr($filecontent, $routefile);
        $filecontent=substr($filecontent, 0, $routefile2).$data2."\r".substr($filecontent, $routefile2)."\n";
        return file_put_contents("routes/web.php", $filecontent);
    }

    /**
     *
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return base_path('routes/web.php');
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
