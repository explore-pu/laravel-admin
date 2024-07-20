<?php

namespace Elegant\Admin\Form\Field;

use Elegant\Admin\Table\Selectable;

trait BelongsToRelation
{
    /**
     * @var string
     */
    protected $selectable;

    /**
     * BelongsToRelation constructor.
     *
     * @param string $column
     * @param array  $arguments
     */
    public function __construct($column, $arguments = [])
    {
        $this->setSelectable($arguments[0]);

        parent::__construct($column, array_slice($arguments, 1));
    }

    /**
     * @param string $selectable
     */
    protected function setSelectable($selectable)
    {
        if (!class_exists($selectable) || !is_subclass_of($selectable, Selectable::class)) {
            throw new \InvalidArgumentException(
                "[Class [{$selectable}] must be a sub class of Elegant\Admin\Table\Selectable"
            );
        }

        $this->selectable = $selectable;
    }

    /**
     * @return string
     */
    public function getSelectable()
    {
        return $this->selectable;
    }

    /**
     * @return string
     */
    protected function getLoadUrl()
    {
        $selectable = str_replace('\\', '_', $this->selectable);
        $args = [intval($this instanceof BelongsToMany)];

        return admin_route('handle_selectable', compact('selectable', 'args'));
    }

    /**
     * @return \Elegant\Admin\Table
     */
    protected function makeTable()
    {
        /** @var Selectable $selectable */
        $selectable = new $this->selectable();

        return $selectable->renderFormTable($this->value());
    }

    /**
     * {@inheritdoc}
     */
    public function render()
    {
        $this->addVariables([
            'table'   => $this->makeTable(),
            'options' => $this->getOptions(),
            'modal'   => uniqid('modal-selector-'),
            'url'     => $this->getLoadUrl(),
        ]);

        $this->addCascadeScript();

        return parent::fieldRender();
    }
}
