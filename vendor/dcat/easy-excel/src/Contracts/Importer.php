<?php

namespace Dcat\EasyExcel\Contracts;

use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Dcat\EasyExcel\Support\SheetCollection;
use League\Flysystem\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface Importer extends Excel
{
    /**
     * @param string|UploadedFile $filePath
     * @return $this
     */
    public function file($filePath);

    /**
     * @param int|\Closure $lineNumberOrCallback
     * @return mixed
     */
    public function headingRow($lineNumberOrCallback);

    /**
     * @return Sheets
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function sheets();

    /**
     * 根据名称或序号获取sheet.
     *
     * @param int|string $indexOrName
     * @return Sheet
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function sheet($indexOrName): Sheet;

    /**
     * @param callable $callback
     * @return $this
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function each(callable $callback);

    /**
     * 获取第一个sheet.
     *
     * @return Sheet
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function first(): Sheet;

    /**
     * 获取当前打开的sheet.
     *
     * @return Sheet
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function active(): Sheet;

    /**
     * @return array
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function toArray(): array;

    /**
     * @return SheetCollection
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function collect(): SheetCollection;
}
