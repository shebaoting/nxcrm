<?php

namespace Dcat\EasyExcel\Contracts;

use Box\Spout\Reader\SheetInterface;
use Dcat\EasyExcel\Support\SheetCollection;

interface Sheet
{
    /**
     * @return bool
     */
    public function valid(): bool;

    /**
     * sheet索引.
     *
     * @return int
     */
    public function getIndex();

    /**
     * @return string
     */
    public function getName();

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @return bool
     */
    public function isVisible();

    /**
     * @return SheetInterface
     */
    public function getSheet();

    /**
     * @param callable $callback
     * @return $this
     */
    public function filter(callable $callback);

    /**
     * 逐行读取.
     *
     * e.g:
     *
     * $this->each(function (array $row, $k, $headers) {
     *      ...
     * });
     *
     * @param callable|null $callback
     * @return $this
     */
    public function each(callable $callback);

    /**
     * 分块读取.
     *
     * e.g:
     *
     * $this->chunk(100, function (SheetCollection $collection) {
     *      ...
     * });
     *
     * @param int $size
     * @param callable $callback
     * @return \Dcat\EasyExcel\Importers\Sheet
     */
    public function chunk(int $size, callable $callback);

    /**
     * @return array
     */
    public function toArray(): array;

    /**
     * @return SheetCollection
     */
    public function collect(): SheetCollection;
}
