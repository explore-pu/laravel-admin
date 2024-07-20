<?php

namespace Elegant\Utils\Table\Filter;

class StartsWith extends Like
{
    protected $exprFormat = '{value}%';
}
