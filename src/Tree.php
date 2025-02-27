<?php

namespace Elegance\Admin;

use Closure;
use Elegance\Admin\Tree\HasActions;
use Elegance\Admin\Tree\Tools;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Tree implements Renderable
{
    use HasActions;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @var string
     */
    protected $elementId = 'tree-';

    /**
     * @var string
     */
    protected $path;

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var \Closure
     */
    protected $queryCallback;

    /**
     * View of tree to render.
     *
     * @var string
     */
    protected $view = [
        'tree'   => 'admin::tree',
        'branch' => 'admin::tree.branch',
    ];

    /**
     * @var \Closure
     */
    protected $callback;

    /**
     * @var null
     */
    protected $branchCallback = null;

    /**
     * @var bool
     */
    public $useCreate = true;

    /**
     * @var bool
     */
    public $useSave = true;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * Header tools.
     *
     * @var Tools
     */
    public $tools;

    /**
     * @var bool
     */
    protected $trashed = true;

    /**
     * Menu constructor.
     *
     * @param Model|null $model
     */
    public function __construct(Model $model = null, \Closure $callback = null)
    {
        $this->model = $model;

        $this->path = \request()->getPathInfo();
        $this->elementId .= uniqid();

        $this->setupTools();

        if ($callback instanceof \Closure) {
            call_user_func($callback, $this);
        }

        $this->initBranchCallback();
    }

    /**
     * Setup tree tools.
     */
    public function setupTools()
    {
        $this->tools = new Tools($this);
    }

    /**
     * Initialize branch callback.
     *
     * @return void
     */
    protected function initBranchCallback()
    {
        if (is_null($this->branchCallback)) {
            $this->branchCallback = function ($branch) {
                $key = $branch[$this->model->getKeyName()];
                $title = $branch[$this->model->getTitleColumn()];

                return "$key - $title";
            };
        }
    }

    /**
     * Set branch callback.
     *
     * @param \Closure $branchCallback
     *
     * @return $this
     */
    public function branch(\Closure $branchCallback)
    {
        $this->branchCallback = $branchCallback;

        return $this;
    }

    /**
     * Set query callback this tree.
     *
     * @return Model
     */
    public function query(\Closure $callback)
    {
        $this->queryCallback = $callback;

        return $this;
    }

    /**
     * Set nestable options.
     *
     * @param array $options
     *
     * @return $this
     */
    public function nestable($options = [])
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }

    /**
     * Disable create.
     *
     * @return void
     */
    public function disableCreate()
    {
        $this->useCreate = false;
    }

    /**
     * Disable save.
     *
     * @return void
     */
    public function disableSave()
    {
        $this->useSave = false;
    }

    /**
     * enable trash
     */
    public function disableTrashed()
    {
        $this->trashed = false;
    }

    /**
     * Save tree order from a input.
     *
     * @param string $serialize
     *
     * @return bool
     */
    public function saveOrder($serialize)
    {
        $tree = json_decode($serialize, true);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \InvalidArgumentException(json_last_error_msg());
        }

        $this->model->saveOrder($tree);

        return true;
    }

    /**
     * Set view of tree.
     *
     * @param string $view
     */
    public function setView($view)
    {
        $this->view = $view;
    }

    /**
     * @return string
     */
    public function resource()
    {
        return url($this->path);
    }

    /**
     * @return Model|null
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return string
     */
    public function getKeyName()
    {
        return $this->model->getKeyName();
    }

    /**
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    protected function requestTrashed(): bool
    {
        return request()->get('_scope_') === 'trashed';
    }

    /**
     * Return all items of the tree.
     *
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getItems()
    {
        return $this->model->withQuery($this->queryCallback)->toTree($this->trashed && $this->requestTrashed());
    }

    /**
     * Setup table tools.
     *
     * @param Closure $callback
     *
     * @return void
     */
    public function tools(Closure $callback)
    {
        call_user_func($callback, $this->tools);
    }

    /**
     * Render a tree.
     *
     * @return JsonResponse|string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws \Throwable
     */
    public function render()
    {
        view()->share([
            'path'           => $this->path,
            'keyName'        => $this->model->getKeyName(),
            'branchView'     => $this->view['branch'],
            'branchCallback' => $this->branchCallback,
            'model'          => get_class($this->model),
        ]);

        return Admin::view($this->view['tree'], [
            'id'         => $this->elementId,
            'tools'      => $this->tools->render(),
            'items'      => $this->getItems(),
            'useCreate'  => $this->useCreate,
            'useSave'    => $this->useSave,
            'trashed'    => $this->trashed,
            'requestTrashed' => $this->requestTrashed(),
            'url'        => url($this->path),
            'options'    => $this->options,
            'actionsCallback' => $this->actionsCallback,
            'actions'        => $this->appendActions(),
        ]);
    }

    /**
     * Get the string contents of the table view.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
