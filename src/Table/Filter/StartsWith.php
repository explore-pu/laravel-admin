<?php

namespace Elegant\Admin\Table\Filter;

class StartsWith extends Like
{
    protected $exprFormat = '{value}%';
}
