<?php

namespace Dcat\EasyExcel\Traits;

use Box\Spout\Common\Entity\Style\Style;
use Box\Spout\Common\Type;
use Box\Spout\Reader\CSV\Reader as CSVReader;
use Box\Spout\Writer\CSV\Writer as CSVWriter;
use Dcat\EasyExcel\Support\SheetCollection;
use Illuminate\Contracts\Filesystem\Filesystem as LaravelFilesystem;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\FilesystemInterface;
use League\Flysystem\FilesystemOperator;
use Symfony\Component\HttpFoundation\File\UploadedFile;

trait Excel
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var \Closure
     */
    protected $optionCallback;

    /**
     * @var array|false
     */
    protected $headings = [];

    /**
     * @var Style|null
     */
    protected $headingStyle;

    /**
     * @var FilesystemInterface
     */
    protected $filesystem;

    /**
     * @var array
     */
    protected $csvConfiguration = [
        'delimiter' => ',',
        'enclosure' => '"',
        'encoding'  => 'UTF-8',
        'bom'       => true,
    ];

    /**
     * @param string|null $type
     * @return $this
     */
    public function type(?string $type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param \Closure $callback
     * @return $this
     */
    public function option(\Closure $callback)
    {
        $this->optionCallback = $callback;

        return $this;
    }

    /**
     * @param array|\Closure|false $headings
     * @return $this
     */
    public function headings($headings)
    {
        if ($headings instanceof \Closure) {
            $temp = $headings();

            if (is_array($temp) && is_array(current($temp))) {
                $headings = &$temp[0] ?? null;
                $style = $temp[1] ?? null;

                if ($style instanceof Style) {
                    $this->headingStyle = $style;
                }
            } else {
                $headings = &$temp;
            }
        }

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
     * @return $this
     */
    public function csv()
    {
        return $this->type(Type::CSV);
    }

    /**
     * @return $this
     */
    public function ods()
    {
        return $this->type(Type::ODS);
    }

    /**
     * @return $this
     */
    public function xlsx()
    {
        return $this->type(Type::XLSX);
    }

    /**
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param FilesystemInterface|LaravelFilesystem|string $filesystem
     * @return $this
     */
    public function disk($filesystem)
    {
        if (is_string($filesystem)) {
            $filesystem = Storage::disk($filesystem);
        }

        if ($filesystem instanceof LaravelFilesystem) {
            $filesystem = $filesystem->getDriver();
        }

        $this->filesystem = $filesystem;

        return $this;
    }

    /**
     * @return FilesystemInterface|void
     */
    protected function filesystem()
    {
        if (
            $this->filesystem
            && (
                $this->filesystem instanceof FilesystemInterface
                || $this->filesystem instanceof FilesystemOperator
            )
        ) {
            return $this->filesystem;
        }
    }

    /**
     * @param string $delimiter
     * @param string $enclosure
     * @param string $encoding
     * @param bool $bom
     *
     * @return $this
     */
    public function configureCsv(
        string $delimiter = ',',
        string $enclosure = '"',
        string $encoding = 'UTF-8',
        bool $bom = false
    ) {
        $this->csvConfiguration = compact('delimiter', 'enclosure', 'encoding', 'bom');

        return $this;
    }

    /**
     * @param \Box\Spout\Reader\ReaderInterface|\Box\Spout\Writer\WriterInterface $readerOrWriter
     */
    protected function configure(&$readerOrWriter)
    {
        if ($readerOrWriter instanceof CSVReader || $readerOrWriter instanceof CSVWriter) {
            $readerOrWriter->setFieldDelimiter($this->csvConfiguration['delimiter']);
            $readerOrWriter->setFieldEnclosure($this->csvConfiguration['enclosure']);

            if ($readerOrWriter instanceof CSVReader) {
                $readerOrWriter->setEncoding($this->csvConfiguration['encoding']);
            }

            if ($readerOrWriter instanceof CSVWriter) {
                $readerOrWriter->setShouldAddBOM($this->csvConfiguration['bom']);
            }
        }

        if ($this->optionCallback) {
            ($this->optionCallback)($readerOrWriter);
        }
    }

    /**
     * @param string $fileName
     * @return string|UploadedFile
     */
    protected function prepareFileName($fileName)
    {
        if ($fileName instanceof UploadedFile) {
            return $fileName;
        }

        if ($this->type && strpos($fileName, '.') === false) {
            return $fileName.'.'.$this->type;
        }

        return $fileName;
    }

    /**
     * @param mixed $value
     * @return array
     */
    protected function convertToArray($value)
    {
        if (is_array($value)) {
            return $value;
        }

        if ($value instanceof SheetCollection || method_exists($value, 'toArray')) {
            return $value->toArray();
        }

        return (array) $value;
    }

    /**
     * Generate a more truly "random" alpha-numeric string.
     *
     * @param  int  $length
     * @return string
     */
    public static function generateRandomString($length = 16)
    {
        $string = '';

        while (($len = strlen($string)) < $length) {
            $size = $length - $len;

            $bytes = random_bytes($size);

            $string .= substr(str_replace(['/', '+', '='], '', base64_encode($bytes)), 0, $size);
        }

        return $string;
    }
}
