<?php

namespace App\Admin\Traits;


use Dcat\Admin\Widgets\Modal;

trait ChangeUser

{
    protected function Change($id,$model)
    {
        return Modal::make()
            ->lg()
            ->title('选择需要分配的人员')
            ->body(view('admin/'.$model.'/_change',['id' => $id,'model' => $model]))
            ->button('<span class="btn btn-sm btn-primary"><span class="feather icon-refresh-cw"></span> 分配销售人员</span>');
    }
}
