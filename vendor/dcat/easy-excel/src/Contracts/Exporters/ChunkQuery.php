<?php

namespace Dcat\EasyExcel\Contracts\Exporters;

interface ChunkQuery
{
    /**
     * @return \Generator[]
     */
    public function makeGenerators();
}
