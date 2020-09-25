<?php

namespace Tests\Exporters\XLSX;

use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\SheetCollection;
use Tests\Exporters\Exporter;
use Tests\TestCase;

class HeadingTest extends TestCase
{
    use Exporter;

    protected $headings = [
        'id'                => 'ID',
        'name'              => '名称',
        'email'             => '邮箱',
        'email_verified_at' => '邮箱验证时间',
        'password'          => '密码',
        'remember_token'    => '记住登录Token',
        'created_at'        => '创建时间',
        'updated_at'        => '更新时间',
    ];

    protected $headings2 = [
        'id'                => 'ID',
        'name'              => '名称',
        'email'             => '邮箱',
        'email_verified_at' => '邮箱验证时间',
        'remember_token'    => '记住登录Token',
        'password'          => '密码',
    ];

    /**
     * @group exporter
     */
    public function test()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('xlsx');

        // 保存
        Excel::export($users)->headings($this->headings)->store($storePath);

        // 读取
        $sheet = Excel::import($storePath)->first()->toArray();

        $this->assertSheetHeadings($sheet, $this->headings);

        /*
         |---------------------------------------------------------------
         | 读取时禁用标题
         |---------------------------------------------------------------
        */
        $sheet = Excel::import($storePath)->headings(false)->first()->toArray();
        $firstRow = current($sheet);

        $this->assertIsArray($firstRow);
        $this->assertEquals(count($firstRow), count($this->headings));
        $this->assertEquals(array_keys($firstRow), range(0, count($this->headings) - 1));

        /*
         |---------------------------------------------------------------
         | 多个sheets用同样的标题
         |---------------------------------------------------------------
        */
        $users1 = new SheetCollection(array_slice($users, 0, 30));
        $users2 = new SheetCollection(array_values(array_slice($users, 30, 30)));

        Excel::export(['sheet1' => $users1->toArray(), 'sheet2' => $users2->toArray()])->headings($this->headings)->store($storePath);

        // 读取
        $sheets = Excel::import($storePath)->toArray();

        $this->assertTrue(isset($sheets['sheet1']));
        $this->assertTrue(isset($sheets['sheet2']));

        $this->assertSheetHeadings($sheets['sheet1'], $this->headings);
        $this->assertSheetHeadings($sheets['sheet2'], $this->headings);
    }

    /**
     * @group exporter
     */
    public function testMultipleSheets()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $sheet1 = Excel::createSheet(array_slice($users, 0, 30))->headings($this->headings);
        $sheet2 = Excel::createSheet(array_slice($users, 30, 30))->headings($this->headings2);

        $storePath = $this->generateTempFilePath('xlsx');

        // 保存
        Excel::export([$sheet1, $sheet2])->store($storePath);

        // 读取
        $sheetsArray = Excel::import($storePath)->toArray();

        $this->assertTrue(isset($sheetsArray['Sheet1']));
        $this->assertTrue(isset($sheetsArray['Sheet2']));

        $this->assertSheetHeadings($sheetsArray['Sheet1'], $this->headings);
        $this->assertSheetHeadings($sheetsArray['Sheet2'], $this->headings2);

        /*
        |---------------------------------------------------------------
        | 测试禁用其中一个表格标题
        |---------------------------------------------------------------
       */
        $sheet1 = Excel::createSheet(array_slice($users, 0, 30))->headings($this->headings);
        $sheet2 = Excel::createSheet(array_slice($users, 30, 30))->headings(false);

        $storePath = $this->generateTempFilePath('xlsx');

        // 保存
        Excel::export([$sheet1, $sheet2])->store($storePath);

        // 读取
        $sheetsArray = Excel::import($storePath)->headings(false)->toArray();

        $this->assertTrue(isset($sheetsArray['Sheet1']));
        $this->assertTrue(isset($sheetsArray['Sheet2']));

        $this->assertEquals(count($sheetsArray['Sheet1']), 31);
        $this->assertEquals(count($sheetsArray['Sheet2']), 30);

        $this->assertEquals(current($sheetsArray['Sheet1']), array_values($this->headings));
    }

    /**
     * @param $sheetArray
     * @param array $headings
     */
    protected function assertSheetHeadings($sheetArray, array $headings)
    {
        $firstRowInSheet = current($sheetArray);

        $this->assertIsArray($firstRowInSheet);
        $this->assertEquals(count($firstRowInSheet), count($headings));
        $this->assertEquals(array_keys($firstRowInSheet), array_values($headings));
    }
}
