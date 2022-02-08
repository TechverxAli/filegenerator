<?php
namespace Techverx\Contact;
use Illuminate\Support\ServiceProvider;
use Techverx\Contact\src\App\Console\TinkerCommand;

class ContactServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([__DIR__.'/App/Console/Commands/MakeBaseRepo.php' => base_path('/app/Console/Commands/MakeBaseRepo.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/MakeBaseService.php' => base_path('/app/Console/Commands/MakeBaseService.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/MakeController.php' => base_path('/app/Console/Commands/MakeController.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/MakeIRepo.php' => base_path('/app/Console/Commands/MakeIRepo.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/MakeIService.php' => base_path('/app/Console/Commands/MakeIService.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/MakeModel.php' => base_path('/app/Console/Commands/MakeModel.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/MakeRoute.php' => base_path('/app/Console/Commands/MakeRoute.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/ModelMakeCommand.php' => base_path('/app/Console/Commands/ModelMakeCommand.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/RepositoryMakeCommand.php' => base_path('/app/Console/Commands/RepositoryMakeCommand.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/ServiceMakeCommand.php' => base_path('/app/Console/Commands/ServiceMakeCommand.php')]);
        $this->publishes([__DIR__.'/App/Console/Commands/SingleCommand.php' => base_path('/app/Console/Commands/SingleCommand.php')]);

        //Stubs
        $this->publishes([__DIR__.'/stubs/model.stub' => base_path('/app/Console/stubs/model.stub')]);
        $this->publishes([__DIR__.'/stubs/BaseService.stub' => base_path('/app/Console/stubs/BaseService.stub')]);
        $this->publishes([__DIR__.'/stubs/controller.stub' => base_path('/app/Console/stubs/controller.stub')]);
        $this->publishes([__DIR__.'/stubs/IRepo.stub' => base_path('/app/Console/stubs/IRepo.stub')]);
        $this->publishes([__DIR__.'/stubs/IService.stub' => base_path('/app/Console/stubs/IService.stub')]);
        $this->publishes([__DIR__.'/stubs/service.stub' => base_path('/app/Console/stubs/service.stub')]);
        $this->publishes([__DIR__.'/stubs/routes' => base_path('/app/Console/stubs/routes')]);
        $this->publishes([__DIR__.'/stubs/Repository.stub' => base_path('/app/Console/stubs/Repository.stub')]);
        $this->publishes([__DIR__.'/stubs/BaseRepo.stub' => base_path('/app/Console/stubs/BaseRepo.stub')]);
        $this->publishes([__DIR__.'/stubs/pivot.model.stub' => base_path('/app/Console/stubs/pivot.model.stub')]);

    }

    public function register()
    {

    }
}

