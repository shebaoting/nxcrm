<?php

namespace Tests\Exporters\XLSX;

use Box\Spout\Common\Entity\Style\Color;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\SheetCollection;
use Tests\Exporters\Exporter;
use Tests\TestCase;

class WithSheetTest extends TestCase
{
    use Exporter;

    /**
     * @group exporter
     */
    public function test()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('xlsx');

        $sheet = Excel::createSheet($users)
            ->name('test')
            ->headingStyle(
                (new StyleBuilder)
                    ->setFontColor(Color::BLUE)
                    ->setFontSize(14)
                    ->build()
            )
            ->row(function (array $row) {
                $style = (new StyleBuilder)
                    ->setFontColor(Color::PURPLE)
                    ->setFontSize(14)
                    ->build();

                return WriterEntityFactory::createRowFromArray($row, $style);
            });

        // 保存
        Excel::export($sheet)->store($storePath);

        // 读取
        $this->assertSingleSheet($storePath, 'test', $users);

        /*
        |---------------------------------------------------------------
        | 测试多个sheet
        |---------------------------------------------------------------
       */
        $users1 = new SheetCollection(array_slice($users, 0, 30));
        $users2 = new SheetCollection(array_values(array_slice($users, 30, 30)));

        $storePath = $this->generateTempFilePath('xlsx');

        $sheet1 = Excel::createSheet($users1, 'sheet1');
        $sheet2 = Excel::createSheet($users2, 'sheet2');

        // 保存
        Excel::export([$sheet1, $sheet2])->store($storePath);

        $this->assertSheets($storePath, $users1->toArray(), $users2->toArray());
    }

    public function testWithChunkQuery()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $users1 = new SheetCollection(array_slice($users, 0, 30));
        $users2 = new SheetCollection(array_values(array_slice($users, 30, 30)));

        $storePath = $this->generateTempFilePath('xlsx');

        $sheet1 = Excel::createSheet()->name('sheet1')->chunk(function (int $times) use ($users1) {
            return $users1->forPage($times, 10);
        });

        $sheet2 = Excel::createSheet()->name('sheet2')->chunk(function (int $times) use ($users2) {
            return $users2->forPage($times, 10);
        });

        // 保存
        Excel::export([$sheet1, $sheet2])->store($storePath);

        $this->assertSheets($storePath, $users1->toArray(), $users2->toArray());
    }
}
