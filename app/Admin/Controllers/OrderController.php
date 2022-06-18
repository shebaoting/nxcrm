<?php

namespace App\Admin\Controllers;

use App\Models\CrmOrder;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class OrderController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(CrmOrder::with(['CrmContract','CrmProduct']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('CrmContract.signdate', '销售日期')->display(function ($aaaa) {
                return $aaaa;
            });
            $grid->column('CrmProduct.name', '产品名称')->display(function ($aaaa) {
                return $aaaa;
            });
            $grid->column('executionprice');
            $grid->column('quantity');
            $grid->column('CrmContract.id', '所属合同')->display(function ($aaaa) {
                return $aaaa;
            })->link(function ($value) {
                return admin_url('contracts/'.$value);
            });
            $grid->model()->orderBy('id', 'desc');
            $grid->disableActions();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->disableRefreshButton();
            $grid->toolsWithOutline(false);
            $grid->disableFilterButton();
            $grid->quickSearch('CrmContract.title','CrmProduct.name')->placeholder('合同名称或者产品名称');
        });
    }
}
