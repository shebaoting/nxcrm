<?php

namespace App\Admin\Renderable;

use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use Dcat\Admin\Models\Administrator;

class UserTable extends LazyRenderable
{
    public function grid(): Grid
    {

        return Grid::make(Administrator::with(['roles']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name');
            if (config('admin.permission.enable')) {
                $grid->column('roles')->pluck('name')->label('primary', 3);
            }
            $grid->paginate(10);
            $grid->disableActions();
        });
    }
}
