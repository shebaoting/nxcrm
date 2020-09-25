<?php

namespace Tests\Exporters\XLSX;

use Dcat\EasyExcel\Excel;
use Tests\Exporters\Exporter;
use Tests\TestCase;

class WithGeneratorTest extends TestCase
{
    use Exporter;

    /**
     * @group exporter
     */
    public function testStore()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('xlsx');

        // 保存
        Excel::export($this->makeGenerator($users))->store($storePath);

        // 读取
        $this->assertSingleSheet($storePath, 'Sheet1', $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = array_slice($users, 0, 30);
        $users2 = array_values(array_slice($users, 30, 30));

        $storePath = $this->generateTempFilePath('xlsx');

        Excel::xlsx([
            'sheet1' => $this->makeGenerator($users1),
            'sheet2' => $this->makeGenerator($users2),
        ])->store($storePath);

        // 读取
        $this->assertSheets($storePath, $users1, $users2);
    }

    public function testRaw()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('xlsx');

        // 保存
        $contents = Excel::xlsx($this->makeGenerator($users))->raw();

        $this->assertIsString($contents);

        file_put_contents($storePath, $contents);

        // 读取
        $this->assertSingleSheet($storePath, 'Sheet1', $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = array_slice($users, 0, 30);
        $users2 = array_values(array_slice($users, 30, 30));

        $storePath = $this->generateTempFilePath('xlsx');

        $contents = Excel::xlsx([
            'sheet1' => $this->makeGenerator($users1),
            'sheet2' => $this->makeGenerator($users2),
        ])->raw();

        $this->assertIsString($contents);

        file_put_contents($storePath, $contents);

        // 对比
        $this->assertSheets($storePath, $users1, $users2);
    }

    protected function makeGenerator(array $values)
    {
        while ($value = array_shift($values)) {
            yield $value;
        }
    }
}
