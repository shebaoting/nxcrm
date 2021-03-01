<?php

namespace Dcat\EasyExcel\Importers;

use Box\Spout\Common\Entity\Row;
use Box\Spout\Reader\SheetInterface;
use Dcat\EasyExcel\Contracts;
use Dcat\EasyExcel\Support\Arr;
use Dcat\EasyExcel\Support\SheetCollection;

class Sheet implements Contracts\Sheet
{
    /**
     * @var Importer
     */
    protected $importer;

    /**
     * @var SheetInterface
     */
    protected $sheet;

    /**
     * @var callable
     */
    protected $filterCallback;

    public function __construct(Importer $importer, SheetInterface $sheet)
    {
        $this->importer = $importer;
        $this->sheet = $sheet;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return $this->sheet ? true : false;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
        return $this->sheet->getIndex();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->sheet->getName();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->sheet->isActive();
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->sheet->isVisible();
    }

    /**
     * @return SheetInterface
     */
    public function getSheet()
    {
        return $this->sheet;
    }

    /**
     * @param callable $callback
     * @return \Dcat\EasyExcel\Contracts\Sheet
     */
    public function filter(callable $callback)
    {
        $this->filterCallback = $callback;

        return $this;
    }

    /**
     * 逐行读取.
     *
     * @param callable|null $callback
     * @return $this
     */
    public function each(callable $callback)
    {
        $headings = [];
        $originalHeaders = [];
        $headingLine = null;

        foreach ($this->sheet->getRowIterator() as $line => $row) {
            $row = $row instanceof Row ? $row->toArray() : (is_array($row) ? $row : []);

            if (! $this->withoutHeadings()) {
                if ($headingLine === null && $this->isHeadingRow($line, $row)) {
                    $headingLine = $line;
                    $originalHeaders = $row;
                    $headings = $this->formatHeadings($row);

                    continue;
                }

                if ($headingLine === null) {
                    continue;
                }
            }

            $row = $this->formatRow($row, $headings);

            if ($this->exclude($line, $row)) {
                continue;
            }

            if (call_user_func($callback, $row, $line, $originalHeaders) === false) {
                break;
            }
        }
    }

    /**
     * @param int $line
     * @param array $row
     * @return bool
     */
    protected function exclude($line, array $row)
    {
        if (! $this->filterCallback) {
            return false;
        }

        return call_user_func($this->filterCallback, $row, $line) ? false : true;
    }

    /**
     * 分块读取.
     *
     * @param int $size
     * @param callable $callback
     * @return $this
     */
    public function chunk(int $size, callable $callback)
    {
        $chunkData = [];

        $this->each(function (array $row, $k) use ($size, &$chunkData, &$callback) {
            $chunkData[$k] = $row;

            if (count($chunkData) >= $size) {
                call_user_func($callback, new SheetCollection($chunkData));

                $chunkData = [];
            }
        });

        if ($chunkData) {
            call_user_func($callback, new SheetCollection($chunkData));
        }

        unset($chunkData);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        $this->each(function (array $row, $k) use (&$array) {
            $array[$k] = $row;
        });

        return $array;
    }

    /**
     * @return SheetCollection
     */
    public function collect(): SheetCollection
    {
        return new SheetCollection($this->toArray());
    }

    /**
     * 判断是否是标题行.
     *
     * @return bool
     */
    protected function isHeadingRow($line, array $row)
    {
        if (
            is_numeric($this->importer->headingRow)
            && $line == $this->importer->headingRow
        ) {
            return true;
        }

        if ($this->importer->headingRow instanceof \Closure) {
            return ($this->importer->headingRow)($line, $row) ? true : false;
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function withoutHeadings()
    {
        return $this->importer->getHeadings() === false;
    }

    /**
     * @param array $row
     * @param array $headings
     * @return array
     */
    protected function formatRow(array &$row, array $headings)
    {
        if ($this->withoutHeadings()) {
            return $row;
        }

        $countHeaders = count($headings);

        $countRow = count($row);

        if ($countHeaders > $countRow) {
            $row = array_merge($row, array_fill(0, $countHeaders - $countRow, null));
        } elseif ($countHeaders < $countRow) {
            $row = array_slice($row, 0, $countHeaders);
        }

        return array_combine($headings, $row);
    }

    /**
     * @param array $row
     * @return array|false|mixed
     */
    protected function formatHeadings(array &$row)
    {
        if ($headings = $this->importer->getHeadings()) {
            return Arr::isAssoc($headings) ? array_keys($headings) : $headings;
        }

        return $this->toStrings($row);
    }

    /**
     * @param array $values
     * @return array
     */
    protected function toStrings(array $values)
    {
        foreach ($values as &$value) {
            if ($value instanceof \Datetime) {
                $value = $value->format('Y-m-d H:i:s');
            } elseif ($value) {
                $value = (string) $value;
            }
        }

        return $values;
    }
}
