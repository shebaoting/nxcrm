<?php

namespace Tests;

use PHPUnit\Framework\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @param array $values
     * @return array
     */
    protected function convertDatetimeObjectToString(array $values)
    {
        foreach ($values as &$value) {
            if ($value instanceof \Datetime) {
                $value = $value->format('Y-m-d H:i:s');
            }
        }

        return $values;
    }
}
