<?php

namespace Dcat\EasyExcel\Exporters;

use Box\Spout\Common\Entity\Row;
use Box\Spout\Common\Entity\Style\Style;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Writer\CSV\Writer as CsvWriter;
use Box\Spout\Writer\WriterInterface;
use Dcat\EasyExcel\Contracts;
use Dcat\EasyExcel\Excel;
use Dcat\EasyExcel\Support\Arr;
use Generator;

/**
 * @mixin Contracts\Exporter
 */
trait WriteSheet
{
    /**
     * @var array
     */
    protected $writedHeadings = [];

    /**
     * @param WriterInterface $writer
     * @return WriterInterface
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    protected function writeSheets(WriterInterface $writer)
    {
        $sheets = $this->makeSheetsArray($this->data);
        $keys = array_keys($sheets);
        $lastKey = end($keys);

        foreach ($sheets as $index => $sheet) {
            $data = $sheet->getData();
            $name = $sheet->getName();

            if ($data instanceof \Generator) {
                $this->writeRowsFromGenerator($writer, $index, $data, $sheet);
            } else {
                $data = $this->convertToArray($data);

                $this->writeRowsFromArray($writer, $index, $data, $sheet);
            }

            if (is_string($name) && method_exists($writer, 'getCurrentSheet')) {
                $writer->getCurrentSheet()->setName($name);
            }

            if ($lastKey !== $index && method_exists($writer, 'addNewSheetAndMakeItCurrent')) {
                $writer->addNewSheetAndMakeItCurrent();
            }
        }

        return $writer;
    }

    /**
     * @param WriterInterface $writer
     * @param int|string $index
     * @param array $rows
     * @param Contracts\Exporters\Sheet $sheet
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    protected function writeRowsFromArray(WriterInterface $writer, $index, array &$rows, Contracts\Exporters\Sheet $sheet)
    {
        // Add heading row.
        if ($this->canWriteHeadings($writer, $index, $sheet)) {
            $this->writeHeadings($writer, $sheet, current($rows));
        }

        foreach ($rows as &$row) {
            $this->writeRow($writer, $row, $sheet);
        }
    }

    /**
     * @param WriterInterface $writer
     * @param int $index
     * @param Generator $generator
     * @param Contracts\Exporters\Sheet $sheet
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    protected function writeRowsFromGenerator(WriterInterface $writer, $index, Generator $generator, Contracts\Exporters\Sheet $sheet)
    {
        foreach ($generator as $key => $items) {
            $items = $this->convertToArray($items);

            if (! is_array(current($items))) {
                $items = [$items];
            }

            $this->writeRowsFromArray($writer, $index, $items, $sheet);
        }
    }

    /**
     * @param WriterInterface $writer
     * @param array $item
     * @param Contracts\Exporters\Sheet $sheet
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    protected function writeRow(WriterInterface $writer, array &$item, Contracts\Exporters\Sheet $sheet)
    {
        $item = $this->formatRow($item, $sheet);

        if ($item && $this->rowCallback && is_array($item)) {
            $item = call_user_func($this->rowCallback, $item, $sheet->getName());
        }

        if ($item && is_array($item)) {
            $item = $this->makeDefaultRow($item);
        }

        if ($item instanceof Row) {
            $writer->addRow($item);
        }
    }

    /**
     * @param WriterInterface $writer
     * @param Contracts\Exporters\Sheet $sheet
     * @param array $firstRow
     * @throws \Box\Spout\Common\Exception\IOException
     * @throws \Box\Spout\Writer\Exception\WriterNotOpenedException
     */
    protected function writeHeadings(WriterInterface $writer, Contracts\Exporters\Sheet $sheet, array $firstRow)
    {
        $headings = $sheet->getHeadings() ?: $this->headings;
        $headingStyle = $sheet->getHeadingStyle() ?: $this->headingStyle;

        $writer->addRow(
            $this->makeDefaultRow(
                $headings ?: array_keys($firstRow),
                $headingStyle
            )
        );
    }

    /**
     * @param array $item
     * @param Style|null $style
     * @return Row
     */
    protected function makeDefaultRow(array $item, ?Style $style = null)
    {
        if ($style) {
            return WriterEntityFactory::createRowFromArray($item, $style);
        }

        return WriterEntityFactory::createRowFromArray($item);
    }

    /**
     * @param WriterInterface $writer
     * @param int|string $index
     * @param Contracts\Exporters\Sheet $sheet
     * @return bool
     */
    protected function canWriteHeadings(WriterInterface $writer, $index, Contracts\Exporters\Sheet $sheet): bool
    {
        $sheetHeadings = $sheet->getHeadings();

        if (
            ($sheetHeadings === false)
            || ($this->headings === false && ! $sheetHeadings)
            || ! empty($this->writedHeadings[$index])
            || ($this->writedHeadings && $writer instanceof CsvWriter)
        ) {
            return false;
        }

        $this->writedHeadings[$index] = true;

        return true;
    }

    /**
     * @param Contracts\Exporters\ChunkQuery|\Closure|Contracts\Exporters\Sheet[]|array|Generator|Generator[] $data
     * @return Contracts\Exporters\Sheet[]
     */
    protected function makeSheetsArray($data): array
    {
        if ($data instanceof \Closure) {
            $data = $data($this);
        }

        if ($data instanceof Contracts\Exporters\ChunkQuery) {
            $sheets = [];

            foreach ($data->makeGenerators() as $k => $generator) {
                $sheets[] = Excel::createSheet($generator, $k);
            }

            return $sheets;
        }

        if ($data instanceof Contracts\Exporters\Sheet) {
            return [$data];
        }

        if (
            is_object($data) && method_exists($data, 'toArray')
        ) {
            $data = $data->toArray();
        }

        $isArray = is_array($data);

        if (
            ($isArray && ! Arr::isAssoc($data) && ! is_object(current($data)))
            || $data instanceof Generator
        ) {
            return [Excel::createSheet($data)];
        }

        if ($isArray && is_array(current($data)) && ! Arr::isAssoc(current($data))) {
            foreach ($data as $k => &$value) {
                $value = Excel::createSheet($value, $k);
            }

            return $data;
        }

        if ($isArray) {
            $sheets = [];

            foreach ($data as $k => &$value) {
                if ($value instanceof Contracts\Exporters\Sheet) {
                    $sheets[] = $value;
                } elseif ($value instanceof Generator) {
                    $sheets[] = Excel::createSheet($value, $k);
                }
            }

            return $sheets;
        }

        return [];
    }

    /**
     * @param array $row
     * @param Contracts\Exporters\Sheet $sheet
     * @return array
     */
    protected function formatRow(array &$row, Contracts\Exporters\Sheet $sheet)
    {
        $values = [];

        foreach ($this->filterAndSortByHeaders($row, $sheet) as $k => &$value) {
            if (is_scalar($value) || is_null($value)) {
                $values[$k] = $value;
            }
        }

        return $sheet->formatRow($values);
    }

    /**
     * @param array $row
     * @param Contracts\Exporters\Sheet $sheet
     * @return array
     */
    public function filterAndSortByHeaders(array &$row, Contracts\Exporters\Sheet $sheet)
    {
        if ($this->headings === false && ! $sheet->getHeadings()) {
            return $row;
        }

        $headings = $sheet->getHeadings() ?: $this->headings;

        if (! $headings) {
            return $row;
        }

        $newRow = [];
        foreach ($headings as $key => &$label) {
            $newRow[$key] = $row[$key] ?? null;
        }

        return $newRow;
    }
}
