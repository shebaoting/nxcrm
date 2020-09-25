<?php

namespace Dcat\EasyExcel\Importers;

use Box\Spout\Reader\SheetInterface;
use Dcat\EasyExcel\Contracts;
use Dcat\EasyExcel\Support\SheetCollection;

class NullSheet implements Contracts\Sheet
{
    /**
     * @return bool
     */
    public function valid(): bool
    {
        return false;
    }

    /**
     * @return int
     */
    public function getIndex()
    {
    }

    /**
     * @return string
     */
    public function getName()
    {
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return false;
    }

    /**
     * @return SheetInterface
     */
    public function getSheet()
    {
    }

    /**
     * @param callable $callback
     * @return \Dcat\EasyExcel\Contracts\Sheet
     */
    public function filter(callable $callback)
    {
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
        return $this;
    }

    public function chunk(int $size, callable $callback)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }

    /**
     * @return SheetCollection
     */
    public function collect(): SheetCollection
    {
        return new SheetCollection($this->toArray());
    }
}
