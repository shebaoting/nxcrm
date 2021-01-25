<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Grid;
use App\Models\CrmContract as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CrmOrder extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;

    public function get (Grid\Model $model) {

        $data = [];
        foreach (Model::query()->cursor() as $item) {
            $item->order = json_decode($item->order, true);
            $item->order ? $item_order = $item->order : $item_order = [];
            foreach ($item_order as $key => $value){
                $item_order[$key]['contract_id'] = $item->id;
                $item_order[$key]['signdate'] = $item->signdate;
            }
            $item->order = $item_order;
            $data = array_merge($data , $item->order);
        }
        list($orderColumn, $orderType) = $model->getSort();
        return $model->makePaginator(
            count($data), // 传入总记录数
            $data ?? [] // 传入数据二维数组
        );
    }
}
