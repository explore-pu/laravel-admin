<?php

namespace Elegance\Admin\Http\Controllers;

use Elegance\Admin\Admin;
use Elegance\Admin\Form;
use Elegance\Admin\Layout\Content;
use Elegance\Admin\Traits\HasResourceActions;
use Elegance\Admin\Traits\HasResponse;
use Illuminate\Routing\Controller;
use Symfony\Component\DomCrawler\Crawler;

class AdminController extends Controller
{
    use HasResourceActions;
    use HasResponse;

    /**
     * Title for current resource.
     *
     * @var string
     */
    protected string $title = 'Title';

    /**
     * Model for current resource.
     *
     * @var string
     */
    protected string $model = 'Model::class';

    /**
     * Set description for following 4 action pages.
     *
     * @var array
     */
    protected array $description = [
        // 'index'  => 'Index',
        // 'show'   => 'Show',
        // 'edit'   => 'Edit',
        // 'create' => 'Create',
    ];

    public function __construct()
    {
        if (method_exists($this, 'title')) {
            $this->title = $this->title();
        }

        if (method_exists($this, 'model')) {
            $this->model = $this->model();
        }

        if (method_exists($this, 'description')) {
            $this->description = $this->description();
        }
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['index'] ?? trans('admin.list'))
            ->body($this->table());
    }

    /**
     * Show interface.
     *
     * @param int $id
     * @param Content $content
     * @return Content
     */
    public function show(int $id, Content $content)
    {
        return $content
            ->title($this->title)
            ->description($this->description['show'] ?? trans('admin.show'))
            ->body($this->detail($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content|string
     */
    public function create(Content $content)
    {
        $content
            ->title($this->title)
            ->description($this->description['create'] ?? trans('admin.create'));

        return $this->renderModalForm($this->form()->create(), $content);
    }

    /**
     * Edit interface.
     *
     * @param int $id
     * @param Content $content
     * @return Content|string
     */
    public function edit(int $id, Content $content)
    {
        $content
            ->title($this->title)
            ->description($this->description['edit'] ?? trans('admin.edit'));

        return $this->renderModalForm($this->form()->edit($id), $content);
    }

    /**
     * @param Form $form
     * @param Content $content
     * @return Content|string
     */
    public function renderModalForm(Form $form, Content $content)
    {
        if (!request()->has('_modal')) {
            return $content->body($form);
        }

        $crawler = new Crawler(
            $form->disableTools()->disableFooterCheck()->render()
        );

        return implode("\r\n", [
            $crawler->filter('form')->outerHtml(),
            Admin::style(),
            Admin::html(),
            Admin::script(),
        ]);
    }
}
