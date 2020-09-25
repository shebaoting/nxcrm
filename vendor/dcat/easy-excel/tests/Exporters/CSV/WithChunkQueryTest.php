<?php

namespace Tests\Exporters\CSV;

use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\SheetCollection;
use Tests\Exporters\Exporter;
use Tests\TestCase;

class WithChunkQueryTest extends TestCase
{
    use Exporter;

    /**
     * @group exporter
     */
    public function testStore()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('csv');

        $collection = (new SheetCollection($users));

        // 保存
        Excel::export()
            ->chunk(function (int $times) use ($collection) {
                $chunkSize = 10;

                return $collection->forPage($times, $chunkSize)->toArray();
            })
            ->store($storePath);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = new SheetCollection(array_slice($users, 0, 30));
        $users2 = new SheetCollection(array_values(array_slice($users, 30, 30)));

        $storePath = $this->generateTempFilePath('csv');

        $chunkSize = 10;

        Excel::csv()->chunk([
            'sheet1' => function (int $times) use ($users1, $chunkSize) {
                return $users1->forPage($times, $chunkSize);
            },
            'sheet2' => function (int $times) use ($users2, $chunkSize) {
                return $users2->forPage($times, $chunkSize);
            },
        ])->store($storePath);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);
    }

    public function testRaw()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('csv');

        $collection = (new SheetCollection($users));

        // 保存
        $contents = Excel::csv()
            ->chunk(function (int $times) use ($collection) {
                $chunkSize = 10;

                return $collection->forPage($times, $chunkSize)->toArray();
            })
            ->raw();

        $this->assertIsString($contents);

        file_put_contents($storePath, $contents);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = new SheetCollection(array_slice($users, 0, 30));
        $users2 = new SheetCollection(array_values(array_slice($users, 30, 30)));

        $storePath = $this->generateTempFilePath('csv');

        $chunkSize = 10;

        $contents = Excel::csv()->chunk([
            'sheet1' => function (int $times) use ($users1, $chunkSize) {
                return $users1->forPage($times, $chunkSize);
            },
            'sheet2' => function (int $times) use ($users2, $chunkSize) {
                return $users2->forPage($times, $chunkSize);
            },
        ])->raw();

        $this->assertIsString($contents);

        file_put_contents($storePath, $contents);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);
    }
}
