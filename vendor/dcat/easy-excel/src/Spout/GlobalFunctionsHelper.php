<?php

namespace Dcat\EasyExcel\Spout;

use Box\Spout\Common\Helper\GlobalFunctionsHelper as Helper;

class GlobalFunctionsHelper extends Helper
{
    public function basename($path, $suffix = null)
    {
        $path = str_replace('\\', '/', $path);

        $path = explode('/', $path);

        $basename = end($path);

        return $suffix ? str_replace('.'.$suffix, '', $basename) : $basename;
    }
}
