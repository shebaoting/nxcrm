<?php

namespace Tests\Importers;

use Box\Spout\Reader\SheetInterface;
use Dcat\EasyExcel\Contracts\Sheet;
use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\SheetCollection;
use Tests\TestCase;

class SheetTest extends TestCase
{
    /**
     * @group importer
     */
    public function testToArray()
    {
        $sheet = $this->makeSheet();

        $this->validateSheetArray($sheet->toArray());
    }

    /**
     * @group importer
     */
    public function testToCollection()
    {
        $sheet = $this->makeSheet();

        $collection = $sheet->collect();

        $this->assertInstanceOf(SheetCollection::class, $collection);

        $this->validateSheetArray($collection->toArray());
    }

    /**
     * @group importer
     */
    public function testEach()
    {
        $rows = [];
        $headers = [];
        $lastLine = 0;

        $this->makeSheet()->each(function (array $row, int $lineNumber, array $originalHeaders) use (&$rows, &$headers, &$lastLine) {
            $rows[] = $row;
            $headers = $originalHeaders;
            $lastLine = $lineNumber;
        });

        $users = include __DIR__.'/../resources/users.php';

        $this->assertEquals(array_keys(current($users)), $headers);

        $this->assertEquals(
            array_values($rows),
            array_slice($users, 0, 30)
        );

        $this->assertEquals($lastLine, 31);
    }

    /**
     * @group importer
     */
    public function testChunk()
    {
        $chunkSize = 20;
        $chunks = [];

        $this->makeSheet()->chunk($chunkSize, function (SheetCollection $collection) use (&$chunks) {
            $chunks[] = array_values($collection->toArray());
        });

        $users = include __DIR__.'/../resources/users.php';
        $users = (new SheetCollection(array_slice($users, 0, 30)))
            ->chunk($chunkSize)
            ->map(function ($collection) {
                return array_values($collection->toArray());
            })
            ->toArray();

        $this->assertEquals($chunks, $users);
    }

    /**
     * @group importer
     */
    public function testSheetMethods()
    {
        $sheet = $this->makeSheet();

        // getName
        $this->assertEquals($sheet->getName(), 'name1');

        // getIndex
        $this->assertEquals($sheet->getIndex(), 0);

        // valid
        $this->assertEquals($sheet->valid(), true);

        // isWorking
        $this->assertEquals($sheet->isActive(), false);

        // isWorking
        $this->assertEquals($this->factory()->active()->isActive(), true);

        // getSheet
        $this->assertInstanceOf(SheetInterface::class, $sheet->getSheet());
    }

    protected function validateSheetArray(array $sheet)
    {
        $this->assertIsArray($sheet);
        $this->assertEquals(count($sheet), 30);

        $sheet = $this->convertDatetimeObjectToString($sheet);

        $users = include __DIR__.'/../resources/users.php';

        $this->assertEquals(
            array_values($sheet),
            array_slice($users, 0, 30)
        );
    }

    protected function makeSheet()
    {
        $sheet = $this->factory()->first();

        $this->assertInstanceOf(Sheet::class, $sheet);

        return $sheet;
    }

    protected function factory()
    {
        $file = __DIR__.'/../resources/test-sheets.xlsx';

        return Excel::xlsx($file);
    }
}
