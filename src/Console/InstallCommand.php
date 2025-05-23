<?php

namespace Elegance\Admin\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the admin package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initAdminDirectory();

        $this->initDatabase();
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function initDatabase()
    {
        $this->call('migrate');

        $userModel = config('admin.database.user_model');

        if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => 'AdminTablesSeeder']);
        }
    }

    /**
     * Initialize the admAin directory.
     *
     * @return void
     */
    protected function initAdminDirectory()
    {
        $this->directory = config('admin.directory');

        if (is_dir($this->directory)) {
            $this->line("<error>{$this->directory} directory already exists !</error> ");

            return;
        }

        $this->makeDir('/');
        $this->line('<info>Admin directory was created:</info> ' . str_replace(base_path(), '', $this->directory));

        $this->makeDir('Controllers');

        $this->createExampleController();

        $this->createHomeController();

        $this->createUserModel();

        $this->createBootstrapFile();
        $this->createRoutesFile();
    }

    /**
     * Create HomeController.
     *
     * @return void
     */
    public function createExampleController()
    {
        $exampleController = $this->directory . '\Controllers\ExampleController.php';
        $contents = $this->getStub('ExampleController');

        $this->laravel['files']->put(
            $exampleController,
            str_replace('DummyNamespace', config('admin.route.namespace'), $contents)
        );
        $this->line('<info>ExampleController file was created:</info> ' . str_replace(base_path(), '', $exampleController));
    }

    /**
     * Create HomeController.
     *
     * @return void
     */
    public function createHomeController()
    {
        $homeController = $this->directory . '\Controllers\HomeController.php';
        $contents = $this->getStub('HomeController');

        $this->laravel['files']->put(
            $homeController,
            str_replace('DummyNamespace', config('admin.route.namespace'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> ' . str_replace(base_path(), '', $homeController));
    }

    /**
     * Replace the User model
     *
     * @return void
     */
    public function createUserModel()
    {
        $userModel = app_path('Models/User.php');
        $contents = $this->getStub('UserModel');

        $this->laravel['files']->put($userModel, $contents);

        $this->line('<info>User Model file was created:</info> ' . str_replace(base_path(), '', $userModel));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createBootstrapFile()
    {
        $file = $this->directory . '\bootstrap.php';

        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutesFile()
    {
        $file = $this->directory . '\routes.php';

        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('admin.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> ' . str_replace(base_path(), '', $file));
    }

    /**
     * Get stub contents.
     *
     * @param $name
     *
     * @return string
     */
    protected function getStub($name)
    {
        return $this->laravel['files']->get(__DIR__ . "/stubs/$name.stub");
    }

    /**
     * Make new directory.
     *
     * @param string $path
     */
    protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
