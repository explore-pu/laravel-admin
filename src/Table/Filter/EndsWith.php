<?php

namespace Elegant\Admin\Table\Filter;

class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
