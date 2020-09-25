<?php

namespace Dcat\EasyExcel\Exporters;

use Dcat\EasyExcel\Contracts\Exporters;

class ChunkQuery implements Exporters\ChunkQuery
{
    /**
     * @var callable[]
     */
    protected $generators;

    /**
     * @param callable|callable[] $generator
     */
    public function __construct($generator)
    {
        $generator = (is_array($generator) && is_callable($generator)) ? [$generator] : $generator;

        $this->generators = (array) $generator;
    }

    /**
     * @return \Generator[]
     */
    public function makeGenerators()
    {
        $generators = [];

        foreach ($this->generators as $key => $generator) {
            $generators[$key] = $this->makeGenerator($generator);
        }

        return $generators;
    }

    /**
     * @param callable|object $callback
     * @return \Generator
     */
    protected function makeGenerator($callback)
    {
        $callback = $this->resolve($callback);

        $times = 1;

        while ($data = $this->fetchArray($callback, $times)) {
            $times++;

            yield $data;
        }
    }

    /**
     * @param callable $callback
     * @param int $times
     * @return array|null
     */
    protected function fetchArray(callable $callback, int $times)
    {
        $data = call_user_func($callback, $times);

        if (empty($data)) {
            return;
        }

        if (is_object($data) && method_exists($data, 'toArray')) {
            $data = $data->toArray();
        }

        if (is_array($data)) {
            return $data;
        }
    }

    /**
     * @param callable $generator
     * @return callable
     */
    protected function resolve(callable $generator)
    {
        if (is_callable($generator)) {
            return $generator;
        }

        return function ($times) use ($generator) {
            return $generator($times);
        };
    }
}
