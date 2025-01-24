<?php

namespace Elegance\Admin\Table\Filter;

class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
