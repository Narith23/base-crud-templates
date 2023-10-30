<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Touhidurabir\StubGenerator\Facades\StubGenerator as StubGeneratorFacade;

class BaseCRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:base-crud {namespace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $namespace = strtolower($this->argument('namespace'));
        $model = ucwords($namespace);
        $controller = ucwords($namespace)."Controller";
        $service = ucwords($namespace)."Service";
        $serviceFolder = ucwords($namespace)."s";

        // Model
        Artisan::call('make:model '.$model);

        // Controllers
        StubGeneratorFacade::from('/app/Stub/Controllers/BaseTemplate.stub')
            ->to('/app/Http/Controllers', true)
            ->as($controller)
            ->withReplacers([
                'class'             => $controller,
                'model'             => $model,
                'modelNamespace'    => $namespace,
                'service'           => $service,
                'serviceFolder'     => $serviceFolder,
                'serviceInstance'   => $service,
                'route'             => $namespace,
                'namespace'         => ucwords($namespace)
            ])
            ->save();

        // Service
        $path = "app/Services/".$serviceFolder;
        File::makeDirectory($path, $mode = 0777, true, true);

        StubGeneratorFacade::from('/app/Stub/Service/Service.stub')
            ->to('/app/Services/'.$serviceFolder , true)
            ->as($service)
            ->withReplacers([
                'class'             => $service,
                'model'             => $model,
                'modelNamespace'    => $namespace,
                'service'           => $service,
                'serviceFolder'   => $serviceFolder,
            ])
            ->save();
    }
}
