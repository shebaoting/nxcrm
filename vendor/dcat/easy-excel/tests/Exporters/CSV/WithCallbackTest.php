<?php

namespace Tests\Exporters\CSV;

use Dcat\EasyExcel\Excel;
use Tests\Exporters\Exporter;
use Tests\TestCase;

class WithCallbackTest extends TestCase
{
    use Exporter;

    /**
     * @group exporter
     */
    public function testStore()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('csv');

        // 保存
        Excel::export(function () use ($users) {
            return $users;
        })->store($storePath);

        // 判断是否正确
        $this->assertSingleSheet($storePath, 0, $users);

        /*
        |---------------------------------------------------------------
        | 测试多个sheet
        |---------------------------------------------------------------
       */
        $users1 = array_slice($users, 0, 30);
        $users2 = array_values(array_slice($users, 30, 30));

        $storePath = $this->generateTempFilePath('csv');

        // 保存
        Excel::export(function () use ($users1, $users2) {
            return ['sheet1' => $users1, 'sheet2' => $users2];
        })->store($storePath);

        $this->assertSingleSheet($storePath, 0, $users);
    }

    /**
     * @group exporter
     */
    public function testRaw()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('csv');

        // 获取内容
        $contents = Excel::csv(function () use ($users) {
            return $users;
        })->raw();

        $this->assertIsString($contents);

        // 保存文件内容
        file_put_contents($storePath, $contents);

        // 判断内容是否正确
        $this->assertSingleSheet($storePath, 0, $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = array_slice($users, 0, 30);
        $users2 = array_values(array_slice($users, 30, 30));

        $storePath = $this->generateTempFilePath('csv');

        // 获取内容
        $contents = Excel::csv(function () use ($users1, $users2) {
            return ['sheet1' => $users1, 'sheet2' => $users2];
        })->raw();

        $this->assertIsString($contents);

        // 保存文件内容
        file_put_contents($storePath, $contents);

        // 判断内容是否正确
        $this->assertSingleSheet($storePath, 0, $users);
    }
}
