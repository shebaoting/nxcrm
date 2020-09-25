<?php

namespace Dcat\EasyExcel;

use Dcat\EasyExcel\Contracts\Exporter;
use Dcat\EasyExcel\Contracts\Importer;

/**
 * @mixin Importer
 * @mixin Exporter
 */
class Factory
{
    /**
     * @var array
     */
    protected static $exporterMethods = [
        'data',
        'row',
        'chunk',
        'download',
        'store',
        'raw',
    ];

    /**
     * @var array
     */
    protected static $importerMethods = [
        'file',
        'sheets',
        'sheet',
        'each',
        'first',
        'active',
        'toArray',
        'collect',
    ];

    /**
     * @var string
     */
    protected $type;

    /**
     * @var array
     */
    protected $constuctParams = [];

    /**
     * @var array
     */
    protected $callers = [];

    public function __construct(string $type, array $params = [])
    {
        $this->type = $type;

        $this->constuctParams = &$params;
    }

    protected function resolveExporter()
    {
        return $this->call(
            Excel::export(...$this->constuctParams)
                ->type($this->type)
        );
    }

    protected function resolveImporter()
    {
        return $this->call(
            Excel::import(...$this->constuctParams)
                ->type($this->type)
        );
    }

    protected function call($excel)
    {
        foreach ($this->callers as $caller) {
            $excel->{$caller['method']}(...$caller['arguments']);
        }

        return $excel;
    }

    public function __call($method, array $arguments = [])
    {
        if (in_array($method, static::$exporterMethods)) {
            return $this->resolveExporter()->{$method}(...$arguments);
        } elseif (in_array($method, static::$importerMethods)) {
            return $this->resolveImporter()->{$method}(...$arguments);
        }

        $this->callers[] = [
            'method'    => $method,
            'arguments' => &$arguments,
        ];

        return $this;
    }
}
