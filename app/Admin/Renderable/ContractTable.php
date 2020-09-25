<?php
namespace App\Admin\Renderable;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\LazyRenderable;
use App\Models\Contract;
use App\Models\Customer;

class ContractTable extends LazyRenderable
{
    public function grid(): Grid
    {
        // 获取外部传递的参数
        $id = $this->id;

        return Grid::make(new Contract(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('title','合同标题');
            // $grid->column('customer_id','所属客户');

            $grid->column('customer_id','所属客户')->display(function($Id) {
                return Customer::find($Id)->name;
            });
            $grid->column('signdate','签订日期');
            $grid->rowSelector()->titleColumn('title');

            $grid->quickSearch(['id', 'title', 'customer_id']);

            $grid->paginate(5);
            $grid->disableActions();
            $grid->model()->orderBy('id', 'desc');
            $grid->filter(function (Grid\Filter $filter) {
                $filter->like('id')->width(4);
                $filter->like('title')->width(20);
                $filter->like('customer_id')->width(4);
            });
        });
    }
}
