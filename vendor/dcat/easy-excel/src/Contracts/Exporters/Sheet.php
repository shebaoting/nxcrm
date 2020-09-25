<?php

namespace Dcat\EasyExcel\Contracts\Exporters;

use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Entity\Style\Style;

interface Sheet
{
    /**
     * @param $data
     * @return $this
     */
    public function data($data);

    /**
     * @param callable $callback
     * @return $this
     */
    public function chunk(callable $callback);

    /**
     * @return array|\Generator
     */
    public function getData();

    /**
     * 传false则禁用标题.
     *
     * @param array|false $headings
     * @return $this
     */
    public function headings($headings);

    /**
     * @return array|false
     */
    public function getHeadings();

    /**
     * @param Style $style
     * @return $this
     */
    public function headingStyle($style);

    /**
     * @return Style
     */
    public function getHeadingStyle();

    /**
     * @param string $name
     * @return $this
     */
    public function name(?string $name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function row(\Closure $callback);

    /**
     * @param array $row
     * @return array|Row
     */
    public function formatRow(array $row);
}
