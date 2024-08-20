<?php

namespace Elegant\Utils\Console;

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

        $userModel = config('elegant-utils.admin.database.user_model');

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
        $this->directory = config('elegant-utils.admin.directory');

        if (is_dir($this->directory)) {
            $this->line("<error>{$this->directory} directory already exists !</error> ");

            return;
        }

        $this->makeDir('/');
        $this->line('<info>Admin directory was created:</info> '.str_replace(base_path(), '', $this->directory));

        $this->makeDir('Controllers');

        $this->createExampleController();
        $this->createHomeController();
        $this->createAuthController();
        $this->createAuthUserController();
        $this->createAuthMenuController();

        $this->createAuthUserModel();
        $this->createAuthMenuModel();

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
        $exampleController = $this->directory.'\Controllers\ExampleController.php';
        $contents = $this->getStub('ExampleController');

        $this->laravel['files']->put(
            $exampleController,
            str_replace('DummyNamespace', config('elegant-utils.admin.route.namespace'), $contents)
        );
        $this->line('<info>ExampleController file was created:</info> '.str_replace(base_path(), '', $exampleController));
    }

    /**
     * Create HomeController.
     *
     * @return void
     */
    public function createHomeController()
    {
        $homeController = $this->directory.'\Controllers\HomeController.php';
        $contents = $this->getStub('HomeController');

        $this->laravel['files']->put(
            $homeController,
            str_replace('DummyNamespace', config('elegant-utils.admin.route.namespace'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> '.str_replace(base_path(), '', $homeController));
    }

    /**
     * Create AuthController.
     *
     * @return void
     */
    public function createAuthController()
    {
        $controller = $this->directory.'\Controllers\AuthController.php';
        $contents = $this->getStub('AuthController');

        $this->laravel['files']->put(
            $controller,
            str_replace('DummyNamespace', config('elegant-utils.admin.route.namespace'), $contents)
        );
        $this->line('<info>AuthController file was created:</info> '.str_replace(base_path(), '', $controller));
    }

    /**
     * Create AuthUserController.
     *
     * @return void
     */
    public function createAuthUserController()
    {
        $controller = $this->directory.'\Controllers\AuthUserController.php';
        $contents = $this->getStub('AuthUserController');

        $this->laravel['files']->put(
            $controller,
            str_replace('DummyNamespace', config('elegant-utils.admin.route.namespace'), $contents)
        );
        $this->line('<info>AuthUserController file was created:</info> '.str_replace(base_path(), '', $controller));
    }

    /**
     * Create AuthMenuController.
     *
     * @return void
     */
    public function createAuthMenuController()
    {
        $controller = $this->directory.'\Controllers\AuthMenuController.php';
        $contents = $this->getStub('AuthMenuController');

        $this->laravel['files']->put(
            $controller,
            str_replace('DummyNamespace', config('elegant-utils.admin.route.namespace'), $contents)
        );
        $this->line('<info>AuthMenuController file was created:</info> '.str_replace(base_path(), '', $controller));
    }

    /**
     * Create AuthUserModel.
     *
     * @return void
     */
    public function createAuthUserModel()
    {
        $model = app_path('Models\AuthUser.php');
        $contents = $this->getStub('AuthUser');

        $this->laravel['files']->put($model, $contents);
        $this->line('<info>AuthUser file was created:</info> '.str_replace(base_path(), '', $model));
    }

    /**
     * Create AuthMenuModel.
     *
     * @return void
     */
    public function createAuthMenuModel()
    {
        $model = app_path('Models\AuthMenu.php');
        $contents = $this->getStub('AuthMenu');

        $this->laravel['files']->put($model, $contents);
        $this->line('<info>AuthMenu file was created:</info> '.str_replace(base_path(), '', $model));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createBootstrapFile()
    {
        $file = $this->directory.'\bootstrap.php';

        $contents = $this->getStub('bootstrap');
        $this->laravel['files']->put($file, $contents);
        $this->line('<info>Bootstrap file was created:</info> '.str_replace(base_path(), '', $file));
    }

    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutesFile()
    {
        $file = $this->directory.'\routes.php';

        $contents = $this->getStub('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('elegant-utils.admin.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> '.str_replace(base_path(), '', $file));
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
        return $this->laravel['files']->get(__DIR__."/stubs/$name.stub");
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
