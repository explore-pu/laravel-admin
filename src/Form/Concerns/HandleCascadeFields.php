<?php

namespace Elegant\Utils\Form\Concerns;

use Elegant\Utils\Form\Field;

trait HandleCascadeFields
{
    /**
     * @param array    $dependency
     * @param \Closure $closure
     */
    public function cascadeGroup(\Closure $closure, array $dependency)
    {
        $group = new Field\CascadeGroup($dependency, $this);

        $this->pushField($group);

        $this->row()->html($group);

        call_user_func($closure, $this);

        $group->end();
    }
}
