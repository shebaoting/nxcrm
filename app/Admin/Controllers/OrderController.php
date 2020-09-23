<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Order;
use App\Models\Product;
use App\Models\Contract;
use Dcat\Admin\Grid;
use Dcat\Admin\Admin;
use Dcat\Admin\Controllers\AdminController;


class OrderController extends AdminController
{
    public static $css = [
        '/static/css/order_grid.css',
    ];
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        Admin::css(static::$css);
        return Grid::make(new Order(), function (Grid $grid) {
            $grid->column('prodname')->display(function($id) {
                return optional(Product::find($id))->name;
            })->width('30%');
            $grid->column('quantity')->display(function ($quantity) {
                return $quantity."<span class='unit'>".optional(Product::find($this->prodname))->unit."<span>";
            });
            $grid->column('executionprice')->display(function ($executionprice) {
                return $executionprice."<span class='executionprice'><s>(原价".optional(Product::find($this->prodname))->price.")</s><span>";
            });
            $grid->column('contract_id')->display(function($id) {
                return '<a href="contracts/'.Contract::find($id)->id.'">'.Contract::find($id)->title.'</a>';
            });
            $grid->column('signdate');
            $grid->disableCreateButton();
            $grid->disableActions();
            $grid->disableBatchActions();
            $grid->disableRowSelector();
        });
    }

}
