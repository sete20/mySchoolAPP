<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:repository {model} {namespace} {type} {createModel?} {createResource?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $repositoryFunctionName = $this->argument('type') . 'RepositoryFile';
        $requestFunctionName =  'RequestFile';
        $ControllerFunctionName =  $this->argument('type') . 'ControllerFile';
        $RepoFileContents = $repositoryFunctionName($this->argument('model'), $this->argument('namespace'));
        $RequestFileRContents = $requestFunctionName($this->argument('model'), $this->argument('namespace'));
        $ControllerFileContent = $ControllerFunctionName($this->argument('model'), $this->argument('namespace'));
        if ($this->argument('createModel') == 'yes') {
            Artisan::call('make:model ' . $this->argument('model') . ' -m');
            $this->info('Created New Model And Migration ' . $this->argument('model'));
        }
        if ($this->argument('createResource') == 'yes') {
            Artisan::call('make:resource ' . $this->argument('namespace') . '/' . $this->argument('model') . 'Resource');
            $this->info('Created New Resource ' . $this->argument('model'));
        }
        $dirs = [
            'repository' =>   'App/Http/Repositories//' . $this->argument('namespace'),
            'request' =>    'App/Http/Requests//' . $this->argument('namespace'),
            'controller' =>    'App/Http/Controllers//' . $this->argument('namespace')
        ];
        checkDirs($dirs);
        $writtenRepo = File::put($dirs['repository'] . '\\' . $this->argument('model') . 'Repository.php', $RepoFileContents);
        $writtenRequest = File::put($dirs['request'] . '\\' . $this->argument('model') . 'Request.php', $RequestFileRContents);
        $writtenController = File::put($dirs['controller'] . '\\' . $this->argument('model') . 'Controller.php', $ControllerFileContent);


        if ($writtenRepo) {
            $this->info('Created new Repo ' . $this->argument('model') . 'Repository.php ');
        } else {
            $this->info('Something went wrong');
        }
        if ($writtenController) {
            $this->info('Created new Controller ' . $this->argument('model') . 'Controller.php ');
        } else {
            $this->info('Something went wrong');
        }
        if ($writtenRequest) {
            $this->info('Created new Request ' . $this->argument('model') . 'Request.php ');
        } else {
            $this->info('Something went wrong');
        }
        return Command::SUCCESS;
    }
}
