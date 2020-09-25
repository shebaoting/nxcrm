<?php

namespace Dcat\EasyExcel\Exporters;

use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Entity\Style\Style;
use Dcat\EasyExcel\Contracts;

class Sheet implements Contracts\Exporters\Sheet
{
    /**
     * 等于false则禁用标题.
     *
     * @var array|false
     */
    protected $headings = [];

    /**
     * @var Style|null
     */
    protected $headingStyle;

    /**
     * @var array|\Generator
     */
    protected $data = [];

    /**
     * @var string
     */
    protected $name;

    /**
     * @var \Closure
     */
    protected $rowCallback;

    public function __construct($data = null, $name = null, array $headings = [])
    {
        $this->data($data);
        $this->name($name);
        $this->headings($headings);
    }

    /**
     * @param $data
     * @return $this
     */
    public function data($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function chunk(callable $callback)
    {
        $chunk = new ChunkQuery($callback);

        return $this->data($chunk->makeGenerators()[0]);
    }

    /**
     * @return array|\Generator
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     *  传false则禁用标题.
     *
     * @param array|false $headings
     * @return $this
     */
    public function headings($headings)
    {
        if (is_array($headings)) {
            $this->headings = $headings;
        } elseif ($headings === false) {
            $this->headings = false;
        }

        return $this;
    }

    /**
     * @return array|false
     */
    public function getHeadings()
    {
        return $this->headings;
    }

    /**
     * @param Style $style
     * @return $this
     */
    public function headingStyle($style)
    {
        $this->headingStyle = $style;

        return $this;
    }

    /**
     * @return Style
     */
    public function getHeadingStyle()
    {
        return $this->headingStyle;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function name(?string $name)
    {
        if (is_string($name)) {
            $this->name = $name;
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function row(\Closure $callback)
    {
        $this->rowCallback = $callback;

        return $this;
    }

    /**
     * @param array $row
     * @param int $line
     * @return array|Row
     */
    public function formatRow(array $row)
    {
        if ($this->rowCallback) {
            $row = call_user_func($this->rowCallback, $row, $this->getName());
        }

        return $row;
    }

    /**
     * @param $data
     * @param $name
     * @param $headings
     * @return Sheet
     */
    public static function make($data, $name, $headings)
    {
        return new static($data, $name, $headings);
    }
}
