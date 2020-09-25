<?php

namespace Dcat\EasyExcel\Contracts;

use Illuminate\Contracts\Filesystem\Filesystem as LaravelFilesystem;
use League\Flysystem\FilesystemInterface;

/**
 * @method $this xlsx()
 * @method $this csv()
 * @method $this ods()
 * @method $this configureCsv(string $delimiter = ',', string $enclosure = '"', string $encoding = 'UTF-8', bool $bom = false)
 */
interface Excel
{
    /**
     * @param \Closure $callback
     * @return $this
     */
    public function option(\Closure $callback);

    /**
     * @param array|\Closure|false $headings
     * @return $this
     */
    public function headings($headings);

    /**
     * @return array|false
     */
    public function getHeadings();

    /**
     * @param string $type
     * @return $this
     */
    public function type(string $type);

    /**
     * @return string|null
     */
    public function getType();

    /**
     * @param FilesystemInterface|LaravelFilesystem|string $filesystem
     * @return $this
     */
    public function disk($filesystem);
}
