<?php

namespace Tests\Importers;

use Dcat\EasyExcel\Contracts;
use Dcat\EasyExcel\Excel;
use Tests\TestCase;

class ImporterTest extends TestCase
{
    /**
     * @group importer
     */
    public function testCsv()
    {
        $file = __DIR__.'/../resources/test.csv';

        $this->assertSheet($file, 0);
    }

    /**
     * @group importer
     */
    public function testXlsx()
    {
        $file = __DIR__.'/../resources/test.xlsx';

        $this->assertSheet($file, 'Sheet1');
    }

    /**
     * @group importer
     */
    public function testWithHeadings()
    {
        $xlsx = __DIR__.'/../resources/test.xlsx';
        $csv = __DIR__.'/../resources/test.csv';

        $headers = [
            'ID', 'NAME', 'EMAIL',
        ];

        // xlsx
        $xlsxSheetArray = Excel::import($xlsx)
            ->headings($headers)
            ->first()
            ->toArray();

        $this->assertEquals($headers, array_keys(current($xlsxSheetArray)));

        // csv
        $csvSheetArray = Excel::import($csv)
            ->headings($headers)
            ->first()
            ->toArray();

        $this->assertEquals($headers, array_keys(current($csvSheetArray)));
    }

    /**
     * @group importer
     */
    public function testWithoutHeadings()
    {
        $xlsx = __DIR__.'/../resources/test.xlsx';
        $csv = __DIR__.'/../resources/test.csv';

        // xlsx
        $sheetArray = Excel::import($xlsx)
            ->headings(false)
            ->first()
            ->toArray();

        $this->assertEquals(range(0, 7), array_keys(current($sheetArray)));

        // csv
        $sheetArray = Excel::import($csv)
            ->headings(false)
            ->first()
            ->toArray();

        $this->assertEquals(range(0, 7), array_keys(current($sheetArray)));
    }

    /**
     * @group importer
     */
    public function testWorking()
    {
        // xlsx
        $file = __DIR__.'/../resources/test.xlsx';

        $sheetArray = Excel::import($file)->active()->toArray();
        $this->validateSheetArray($sheetArray);

        // csv
        $file = __DIR__.'/../resources/test.csv';

        $sheetArray = Excel::import($file)->active()->toArray();
        $this->validateSheetArray($sheetArray);
    }

    /**
     * @group importer
     */
    public function testFirst()
    {
        // xlsx
        $file = __DIR__.'/../resources/test.xlsx';

        $sheetArray = Excel::import($file)->first()->toArray();
        $this->validateSheetArray($sheetArray);

        // csv
        $file = __DIR__.'/../resources/test.csv';

        $sheetArray = Excel::import($file)->first()->toArray();
        $this->validateSheetArray($sheetArray);
    }

    /**
     * @group importer
     */
    public function testGetSheet()
    {
        // xlsx
        $xlsx = __DIR__.'/../resources/test.xlsx';

        $sheetArray = Excel::import($xlsx)->sheet('Sheet1')->toArray();
        $this->validateSheetArray($sheetArray);

        $sheetArray = Excel::import($xlsx)->sheet(0)->toArray();
        $this->validateSheetArray($sheetArray);

        // csv
        $csv = __DIR__.'/../resources/test.csv';

        $sheetArray = Excel::import($csv)->sheet(0)->toArray();
        $this->validateSheetArray($sheetArray);
    }

    /**
     * @group importer
     */
    public function testEach()
    {
        $xlsx = __DIR__.'/../resources/test.xlsx';
        $csv = __DIR__.'/../resources/test.csv';

        Excel::import($xlsx)->each(function (Contracts\Sheet $sheet) {
            $this->validateSheetArray($sheet->toArray());
        });

        Excel::import($csv)->each(function (Contracts\Sheet $sheet) {
            $this->validateSheetArray($sheet->toArray());
        });
    }

    /**
     * @group importer
     */
    public function testToArray()
    {
        $this->assertTrue(true);
    }

    /**
     * @group importer
     */
    public function testHeadingRow()
    {
        $xlsx = __DIR__.'/../resources/heading.xlsx';

        $sheetArray = Excel::import($xlsx)
            ->headingRow(2)
            ->sheet('Sheet1')
            ->toArray();

        $this->validateSheetArray($sheetArray);

        // 闭包测试
        $sheetArray = Excel::import($xlsx)
            ->headingRow(function (int $line, array $row) {
                $first = $row[0];

                return $line == 2;
            })
            ->sheet('Sheet1')
            ->toArray();

        $this->validateSheetArray($sheetArray);
    }

    /**
     * @group importer
     */
    public function testFilter()
    {
        $xlsx = __DIR__.'/../resources/test.xlsx';
        $csv = __DIR__.'/../resources/test.csv';

        $sheetArray = Excel::import($xlsx)
            ->sheet('Sheet1')
            ->filter(function ($row) {
                return $row['id'] > 10;
            })
            ->toArray();

        $this->assertEquals(count($sheetArray), 40);

        $users = include __DIR__.'/../resources/users.php';

        $this->assertEquals(array_values($sheetArray), array_values(array_slice($users, 10, 40)));

        // csv
        $sheetArray = Excel::import($csv)
            ->sheet(0)
            ->filter(function ($row) {
                return $row['id'] > 10;
            })
            ->toArray();

        $this->assertEquals(count($sheetArray), 40);
        $this->assertEquals(array_values($sheetArray), array_values(array_slice($users, 10, 40)));
    }

    protected function assertSheet($file, $key)
    {
        $sheetsArray = Excel::import($file)->toArray();

        $this->assertIsArray($sheetsArray);
        $this->assertEquals(count($sheetsArray), 1);

        $this->assertTrue(isset($sheetsArray[$key]));
        $this->assertIsArray($sheetsArray[$key]);

        $this->validateSheetArray($sheetsArray[$key]);
    }

    protected function validateSheetArray(array $sheetArray)
    {
        $this->assertEquals(count($sheetArray), 50);

        $users = include __DIR__.'/../resources/users.php';

        $this->assertEquals(array_values($sheetArray), array_slice($users, 0, 50));
    }
}
