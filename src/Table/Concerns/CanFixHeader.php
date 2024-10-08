<?php

namespace Elegant\Utils\Table\Concerns;

use Elegant\Utils\Admin;

trait CanFixHeader
{
    public function fixHeader()
    {
        Admin::style(
            <<<'STYLE'
.wrapper, .table-box .box-body {
    overflow: visible;
}

.table-table {
    position: relative;
    border-collapse: separate;
}

.table-table thead tr:first-child th {
    background: white;
    position: sticky;
    top: 0;
    z-index: 1;
}
STYLE
        );
    }
}
