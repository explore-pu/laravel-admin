<?php

namespace Elegance\Admin\Table\Filter;

class StartsWith extends Like
{
    protected $exprFormat = '{value}%';
}
