<?php

namespace Dcat\EasyExcel\Contracts;

use Dcat\EasyExcel\Support\SheetCollection;

interface Sheets
{
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
    public function each(callable $callback);

    /**
     * @param int|string $indexOrName
     * @return Sheet|null
     */
    public function index($indexOrName);

    /**
     * @param int|string $indexOrName
     * @return $this
     */
    public function reject($indexOrName);

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return SheetCollection
     */
    public function collect(): SheetCollection;
}
