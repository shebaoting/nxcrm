<?php

namespace Tests\Importers;

use Dcat\EasyExcel\Contracts\Sheet;
use Dcat\EasyExcel\Contracts\Sheets;
use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\SheetCollection;
use Tests\TestCase;

class SheetsTest extends TestCase
{
    /**
     * @group importer
     */
    public function testToArray()
    {
        $sheetsArray = $this->makeSheets()->toArray();

        $this->validateArray($sheetsArray);
    }

    /**
     * @group importer
     */
    public function testToCollection()
    {
        $sheetCollection = $this->makeSheets()->collect();

        $this->assertInstanceOf(SheetCollection::class, $sheetCollection);

        $this->validateArray($sheetCollection->toArray());
    }

    /**
     * @group importer
     */
    public function testEach()
    {
        $sheet = null;

        $this->makeSheets()->each(function (Sheet $value) use (&$sheet) {
            $sheet = $value;
        });

        $this->assertInstanceOf(Sheet::class, $sheet);
    }

    /**
     * @group importer
     */
    public function testGetByIndex()
    {
        $sheets = $this->makeSheets();

        $this->assertInstanceOf(Sheet::class, $sheet1 = $sheets->index(0));
        $this->assertInstanceOf(Sheet::class, $sheet2 = $sheets->index(1));

        $this->validateArray([
            $sheet1->getName() => $sheet1->toArray(),
            $sheet2->getName() => $sheet2->toArray(),
        ]);
    }

    /**
     * @group importer
     */
    public function testGetByName()
    {
        $sheets = $this->makeSheets();

        $this->assertInstanceOf(Sheet::class, $sheet1 = $sheets->index('name1'));
        $this->assertInstanceOf(Sheet::class, $sheet2 = $sheets->index('name2'));

        $this->validateArray([
            $sheet1->getName() => $sheet1->toArray(),
            $sheet2->getName() => $sheet2->toArray(),
        ]);
    }

    /**
     * 验证内容是否正确.
     *
     * @param array $sheetsArray
     */
    protected function validateArray(array $sheetsArray)
    {
        $this->assertIsArray($sheetsArray);
        $this->assertEquals(count($sheetsArray), 2);
        $this->assertTrue(isset($sheetsArray['name1']));
        $this->assertTrue(isset($sheetsArray['name2']));

        foreach ($sheetsArray as $name => &$values) {
            $this->assertIsArray($values);
            $this->assertEquals(count($values), 30);

            foreach ($values as &$row) {
                $row = $this->convertDatetimeObjectToString($row);
            }
        }

        $users = include __DIR__.'/../resources/users.php';

        $this->assertEquals(
            array_values($sheetsArray['name1']),
            array_slice($users, 0, 30)
        );

        $this->assertEquals(
            array_values($sheetsArray['name2']),
            array_values(array_slice($users, 30, 30))
        );
    }

    protected function makeSheets()
    {
        $file = __DIR__.'/../resources/test-sheets.xlsx';

        $sheets = Excel::xlsx($file)->sheets();

        $this->assertInstanceOf(Sheets::class, $sheets);

        return $sheets;
    }
}
