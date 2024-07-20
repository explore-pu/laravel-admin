<?php

namespace Elegant\Admin\Tree\Displayers;

use Elegant\Admin\Tree;

abstract class AbstractDisplayer
{
    /**
     * @var Tree
     */
    protected $tree;

    /**
     * @var array
     */
    public $row = [];

    public $trashed;

    public $requestTrashed;

    /**
     * Create a new displayer instance.
     *
     * @param Tree $tree
     * @param $trashed
     * @param $requestTrashed
     */
    public function __construct(Tree $tree, $trashed, $requestTrashed)
    {
        $this->tree = $tree;

        $this->trashed = $trashed;

        $this->requestTrashed = $requestTrashed;
    }

    public function setRow($row)
    {
        $this->row = $row;

        return $this;
    }

    /**
     * @return Tree
     */
    public function getTree()
    {
        return $this->tree;
    }

    /**
     * Get key of current row.
     *
     * @return mixed
     */
    public function getKey()
    {
        return $this->row->{$this->tree->getKeyName()};
    }

    /**
     * @param mixed $key
     *
     * @return mixed
     */
    public function getAttribute($key)
    {
        return $this->row->getAttribute($key);
    }

    /**
     * Get url path of current resource.
     *
     * @return string
     */
    public function getResource()
    {
        return $this->tree->resource();
    }

    /**
     * `foo.bar.baz` => `foo[bar][baz]`.
     *
     * @return string
     */
    protected function getPayloadName($name = '')
    {
        $keys = collect(explode('.', $name ?: $this->getName()));

        return $keys->shift().$keys->reduce(function ($carry, $val) {
            return $carry."[$val]";
        });
    }

    /**
     * Display method.
     *
     * @return mixed
     */
    abstract public function display();
}
