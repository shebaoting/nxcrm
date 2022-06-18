<?php

namespace App\Admin\Traits;


use Dcat\Admin\Widgets\Modal;

trait ShareCustomers

{
    protected function Share($id)
    {
        return Modal::make()
            ->lg()
            ->title('选择您需要分享的同事')
            ->body(view('admin/customer/_share',['id' => $id]))
            ->button('<span class="text-primary avatar addshare"><i class="feather icon-plus"></i></span>');
    }
}
