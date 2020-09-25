<?php

namespace Dcat\EasyExcel\Importers;

use Box\Spout\Common\Exception\IOException;
use Box\Spout\Common\Exception\UnsupportedTypeException;
use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Reader\ReaderInterface;
use Dcat\EasyExcel\Contracts;
use Dcat\EasyExcel\Contracts\Sheet as SheetInterface;
use Dcat\EasyExcel\Support\SheetCollection;
use Dcat\EasyExcel\Support\Traits\Macroable;
use Dcat\EasyExcel\Traits\Excel;
use League\Flysystem\FileNotFoundException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class Importer.
 *
 * @author jqh <841324345@qq.com>
 */
class Importer implements Contracts\Importer
{
    use Macroable, Excel, TempFile;

    /**
     * @var ReaderInterface
     */
    protected $reader;

    /**
     * @var string|UploadedFile
     */
    protected $filePath;

    /**
     * @var int|\Closure
     */
    public $headingRow = 1;

    public function __construct($filePath)
    {
        $this->file($filePath);
    }

    /**
     * @param string|UploadedFile $filePath
     * @return $this
     */
    public function file($filePath)
    {
        $this->filePath = $filePath;

        return $this;
    }

    /**
     * @param int|\Closure $lineNumberOrCallback
     * @return mixed
     */
    public function headingRow($lineNumberOrCallback)
    {
        $this->headingRow = $lineNumberOrCallback;

        return $this;
    }

    /**
     * @return Contracts\Sheets
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function sheets()
    {
        try {
            $filePath = $this->prepareFileName($this->filePath);

            if (is_string($filePath) && ($filesystem = $this->filesystem())) {
                $filePath = $this->moveFileToTemp($filesystem, $filePath);
            }

            $reader = $this->makeReader($filePath);

            return new LazySheets($this->readSheets($reader));
        } catch (\Throwable $e) {
            $this->releaseResources();

            throw $e;
        }
    }

    /**
     * 根据名称或序号获取sheet.
     *
     * @param int|string $indexOrName
     * @return Contracts\Sheet
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function sheet($indexOrName): Contracts\Sheet
    {
        return $this->sheets()->index($indexOrName) ?: $this->makeNullSheet();
    }

    /**
     * @return array
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function toArray(): array
    {
        return $this->sheets()->toArray();
    }

    /**
     * @return SheetCollection
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function collect(): SheetCollection
    {
        return $this->sheets()->collect();
    }

    /**
     * @param callable $callback
     * @return $this
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function each(callable $callback)
    {
        $this->sheets()->each($callback);

        return $this;
    }

    /**
     * 获取第一个sheet.
     *
     * @return Contracts\Sheet
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     */
    public function first(): Contracts\Sheet
    {
        $sheet = null;

        $this->sheets()->each(function (SheetInterface $value) use (&$sheet) {
            $sheet = $value;

            return false;
        });

        return $sheet ?: $this->makeNullSheet();
    }

    /**
     * 获取当前打开的sheet.
     *
     * @return Contracts\Sheet
     * @throws FileNotFoundException
     * @throws IOException
     * @throws UnsupportedTypeException
     * @throws UnsupportedTypeException
     */
    public function active(): Contracts\Sheet
    {
        $sheet = null;

        $this->sheets()->each(function (SheetInterface $value) use (&$sheet) {
            if ($value->isActive()) {
                $sheet = $value;

                return false;
            }
        });

        return $sheet ?: $this->makeNullSheet();
    }

    /**
     * @param \Box\Spout\Reader\ReaderInterface $reader
     * @return \Generator
     * @throws \Box\Spout\Reader\Exception\ReaderNotOpenedException
     */
    protected function readSheets(ReaderInterface $reader)
    {
        foreach ($reader->getSheetIterator() as $key => $sheet) {
            yield new Sheet($this, $sheet);
        }

        $this->releaseResources();
    }

    /**
     * @param string|UploadedFile $path
     *
     * @return \Box\Spout\Reader\ReaderInterface
     * @throws \Box\Spout\Common\Exception\UnsupportedTypeException
     * @throws \Box\Spout\Common\Exception\IOException
     */
    protected function makeReader($path)
    {
        $extension = null;
        if ($path instanceof UploadedFile) {
            $extension = $path->guessClientExtension();
            $path = $path->getRealPath();
        }

        /* @var \Box\Spout\Reader\ReaderInterface $reader */
        if ($this->type || $extension) {
            $reader = ReaderFactory::createFromType($this->type ?: $extension);
        } else {
            $reader = ReaderFactory::createFromFile($path);
        }

        $reader->open($path);

        $this->configure($reader);

        return $this->reader = $reader;
    }

    /**
     * @return NullSheet
     */
    protected function makeNullSheet()
    {
        return new NullSheet();
    }

    /**
     * @return void
     */
    protected function releaseResources()
    {
        if ($this->reader) {
            $this->reader->close();
        }

        $this->removeTempFile();
    }
}
