<?php

namespace Tests\Exporters;

use Dcat\EasyExcel\Excel;

trait Exporter
{
    protected $tempFiles = [];

    protected function assertSingleSheet(string $file, $key, array $compares)
    {
        // 读取
        $sheetsArray = Excel::import($file)->toArray();

        $this->assertIsArray($sheetsArray);
        $this->assertEquals(count($sheetsArray), 1);
        $this->assertTrue(isset($sheetsArray[$key]));

        $this->assertEquals(array_values($sheetsArray[$key]), $compares);
    }

    /**
     * @param string $storePath
     * @param array $users1
     * @param array $users2
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \League\Flysystem\FileNotFoundException
     */
    protected function assertSheets($storePath, $users1, $users2)
    {
        // 读取
        $sheetsArray = Excel::import($storePath)->toArray();

        $this->assertIsArray($sheetsArray);
        $this->assertEquals(count($sheetsArray), 2);

        $this->assertTrue(isset($sheetsArray['sheet1']));
        $this->assertTrue(isset($sheetsArray['sheet2']));
        $this->assertEquals(array_values($sheetsArray['sheet1']), $users1);
        $this->assertEquals(array_values($sheetsArray['sheet2']), $users2);
    }

    protected function generateTempFilePath(string $type)
    {
        return $this->tempFiles[] = __DIR__.'/../resources/'
            .uniqid(microtime(true).mt_rand(0, 1000))
            .'.'.$type;
    }

    public function tearDown(): void
    {
        parent::tearDown();

        // 删除临时文件
        foreach ($this->tempFiles as $file) {
            if (is_file($file)) {
                @unlink($file);
            }
        }
    }
}
