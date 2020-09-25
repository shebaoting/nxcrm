<?php

namespace Dcat\EasyExcel\Spout\Writers;

trait Raw
{
    public function openToOutput()
    {
        $this->outputFilePath = $this->globalFunctionsHelper->basename('excel');

        $this->filePointer = $this->globalFunctionsHelper->fopen('php://output', 'w');
        $this->throwIfFilePointerIsNotAvailable();

        $this->openWriter();
        $this->isWriterOpened = true;

        return $this;
    }
}
