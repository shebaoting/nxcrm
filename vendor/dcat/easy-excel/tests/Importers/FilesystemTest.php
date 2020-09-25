<?php

namespace Tests\Importers;

use Dcat\EasyExcel\Excel;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

class FilesystemTest extends ImporterTest
{
    /**
     * @group importer
     */
    public function test()
    {
        $adapter = new Local(__DIR__.'/../resources');

        $filesystem = new Filesystem($adapter);

        $sheetArray = Excel::xlsx('test')
            ->disk($filesystem)
            ->first()
            ->toArray();

        $this->validateSheetArray($sheetArray);
    }
}
