<?php

namespace App\Admin\Repositories;

use Dcat\Admin\Grid;
use App\Models\Contract as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Order extends EloquentRepository
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

            $item_order = $item->order;
            foreach ($item_order as $key => $value){
                $contract_id = ['contract_id' => $item->id];
                $signdate = ['signdate' => $item->signdate];
                $item_order[$key] = array_merge($value,$contract_id,$signdate);
            }
            $item->order = $item_order;
            $data = array_merge($data , $item->order);
        }
        list($orderColumn, $orderType) = $model->getSort();
        return $model -> makePaginator(
            count($data),
            $data
        );
    }
}
