<?php

namespace Tests\Exporters\CSV;

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

        $storePath = $this->generateTempFilePath('csv');

        // 保存
        Excel::export($this->makeGenerator($users))->store($storePath);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = array_slice($users, 0, 30);
        $users2 = array_values(array_slice($users, 30, 30));

        $storePath = $this->generateTempFilePath('csv');

        Excel::csv([
            'sheet1' => $this->makeGenerator($users1),
            'sheet2' => $this->makeGenerator($users2),
        ])->store($storePath);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);
    }

    public function testRaw()
    {
        $users = include __DIR__.'/../../resources/users.php';

        $storePath = $this->generateTempFilePath('csv');

        // 保存
        $contents = Excel::csv($this->makeGenerator($users))->raw();

        $this->assertIsString($contents);

        file_put_contents($storePath, $contents);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);

        /*
         |---------------------------------------------------------------
         | 测试多个sheet
         |---------------------------------------------------------------
        */
        $users1 = array_slice($users, 0, 30);
        $users2 = array_values(array_slice($users, 30, 30));

        $storePath = $this->generateTempFilePath('csv');

        $chunkSize = 10;

        $contents = Excel::csv([
            'sheet1' => $this->makeGenerator($users1),
            'sheet2' => $this->makeGenerator($users2),
        ])->raw();

        $this->assertIsString($contents);

        file_put_contents($storePath, $contents);

        // 读取
        $this->assertSingleSheet($storePath, 0, $users);
    }

    protected function makeGenerator(array $values)
    {
        while ($value = array_shift($values)) {
            yield $value;
        }
    }
}
