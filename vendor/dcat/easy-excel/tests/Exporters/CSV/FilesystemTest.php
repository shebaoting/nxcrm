<?php

namespace Tests\Exporters\CSV;

use Dcat\EasyExcel\Excel;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\Local\LocalFilesystemAdapter;
use Tests\TestCase;

class FilesystemTest extends TestCase
{
    /**
     * @var Filesystem
     */
    protected $filesystem;
    protected $filename;

    public function test()
    {
        $users = include __DIR__.'/../../resources/users.php';

        if (class_exists(LocalFilesystemAdapter::class)) {
            $adapter = new LocalFilesystemAdapter(__DIR__.'/../../resources');
        } else {
            $adapter = new Local(__DIR__.'/../../resources');
        }

        $this->filesystem = new Filesystem($adapter);
        $this->filename = time().'.csv';

        Excel::csv($users)->disk($this->filesystem)->store($this->filename);

        $sheetsArray = Excel::csv($this->filename)->disk($this->filesystem)->toArray();

        $this->assertIsArray($sheetsArray);
        $this->assertEquals(count($sheetsArray), 1);
        $this->assertTrue(isset($sheetsArray[0]));

        $this->assertEquals(array_values($sheetsArray[0]), $users);
    }

    public function tearDown(): void
    {
        parent::tearDown();

        if ($this->filesystem && $this->filename) {
            $this->filesystem->delete($this->filename);
        }
    }
}
