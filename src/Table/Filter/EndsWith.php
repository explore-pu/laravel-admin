<?php

namespace Elegant\Utils\Table\Filter;

class EndsWith extends Like
{
    protected $exprFormat = '%{value}';
}
