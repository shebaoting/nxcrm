<?php

namespace Dcat\EasyExcel\Importers;

use Dcat\EasyExcel\Contracts\Sheet;
use Dcat\EasyExcel\Contracts\Sheets;
use Dcat\EasyExcel\Support\SheetCollection;
use Generator;

class LazySheets implements Sheets
{
    /**
     * @var Generator|Sheet[]
     */
    protected $generator;

    /**
     * @var array
     */
    protected $reject = [];

    public function __construct(Generator $generator)
    {
        $this->generator = $generator;
    }

    /**
     * e.g:.
     *
     * $this->each(function (Sheet $sheet) {
     *
     * });
     *
     * @param callable $callback 返回false可中断循环
     * @return $this
     */
    public function each(callable $callback)
    {
        foreach ($this->generator as $sheet) {
            if ($this->skip($sheet)) {
                continue;
            }

            /* @var Sheet $sheet */
            if (false === call_user_func($callback, $sheet)) {
                break;
            }
        }

        return $this;
    }

    /**
     * @param int|string $indexOrName
     * @return Sheet|null
     */
    public function index($indexOrName)
    {
        foreach ($this->generator as $sheet) {
            if ($this->is($indexOrName, $sheet)) {
                return $sheet;
            }
        }
    }

    /**
     * @param int|string $indexOrName
     * @return $this
     */
    public function reject($indexOrName)
    {
        $this->reject = (array) $indexOrName;

        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];

        $this->each(function (Sheet $sheet) use (&$array) {
            if ($sheet->getName() === '') {
                $array[$sheet->getIndex()] = $sheet->toArray();
            } else {
                $array[$sheet->getName()] = $sheet->toArray();
            }
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
     * @param $indexOrName
     * @param Sheet $sheet
     * @return bool
     */
    protected function is($indexOrName, Sheet $sheet): bool
    {
        if ($indexOrName === $sheet->getName()) {
            return true;
        }

        if (is_numeric($indexOrName) && $sheet->getIndex() === (int) $indexOrName) {
            return true;
        }

        return false;
    }

    /**
     * @param Sheet $sheet
     * @return bool
     */
    protected function skip(Sheet $sheet): bool
    {
        foreach ($this->reject as $indexOrName) {
            if ($this->is($indexOrName, $sheet)) {
                return true;
            }
        }

        return false;
    }
}
