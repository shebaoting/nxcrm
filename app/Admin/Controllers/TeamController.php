<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Http\Repositories\Administrator;
use Dcat\Admin\Models\Administrator as AdministratorModel;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;

class TeamController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(Administrator::with(['roles']), function (Grid $grid) {

            $grid->view('admin.teams.grid');
            $grid->column('id', 'ID')->sortable();
            $grid->column('username');
            $grid->column('name');
            $grid->column('mobile');

            if (config('admin.permission.enable')) {
                $grid->column('roles')->pluck('name')->label('primary', 3);
            }

            // $grid->column('created_at');
            // $grid->column('updated_at')->sortable();

            $grid->quickSearch(['id', 'name', 'username']);

            $grid->disableActions();
            $grid->disableRefreshButton();
            $grid->disableCreateButton();
        });
    }
}
