<?php
namespace App\Admin\Renderable;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use App\Models\CrmCustomer;

class CrmCustomerTable extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;

        return Grid::make(new CrmCustomer(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name','客户名称');
            $grid->rowSelector()->titleColumn('name');
            $grid->quickSearch(['id', 'name',]);
            $grid->paginate(7);
            $grid->disableActions();
            $grid->disableFilterButton();
            $grid->model()->orderBy('id','desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('id')->width(4);
                $filter->like('name')->width(20);
            });
        });
    }
}
