<?php

namespace App\Admin\Renderable;

use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use App\Models\AdminRoleUsers;
use Dcat\Admin\Models\Administrator;

class RoleUser extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;
        $users = AdminRoleUsers::where('role_id', $id)->pluck('user_id')->all();
        return Grid::make(Administrator::whereIn('id',$users), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name', '姓名');
            $grid->paginate(10);
            $grid->disableActions();
        });
    }
}
