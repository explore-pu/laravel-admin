<?php

namespace Elegant\Utils\Table\Exporters;

interface ExporterInterface
{
    /**
     * Export data from table.
     *
     * @return mixed
     */
    public function export();
}
