<?php

namespace App\Admin\Renderable;

use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use App\Models\Role;


class RoleTable extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;
        return Grid::make(Role::where('pid','=',0), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name', '部门名称');
            $grid->paginate(10);
            $grid->disableActions();
        });
    }
}
