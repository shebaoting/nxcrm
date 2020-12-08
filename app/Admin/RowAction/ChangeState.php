<?php

namespace App\Admin\RowAction;

use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Opportunity;

class ChangeState extends RowAction
{
    protected $model;

    public function __construct(array $model = [])
    {
        $this->model_name = $model[0] ?? null;
        $this->model_title = $model[1] ?? null;
        $this->model_info = $model[2] ?? null;
        $this->model_state = $model[3] ?? null;
    }


    /**
     * 标题
     *
     * @return string
     */
    public function title()
    {
        return $this->model_title;
    }

    /**
     * 设置确认弹窗信息，如果返回空值，则不会弹出弹窗
     *
     * 允许返回字符串或数组类型
     *
     * @return array|string|void
     */
    public function confirm()
    {
        return [
            // 确认弹窗 title
            $this->model_info,
            // 确认弹窗 content
            // $this->row->state,
        ];
    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return \Dcat\Admin\Actions\Response
     */
    public function handle(Request $request)
    {
        // 获取当前行ID
        $id = $this->getKey();

        // 获取 parameters 方法传递的参数
        $state = $request->get('state');
        // 改变状态
        if ($request->get('model_name') == 'Customer'){
            $modelFind = Customer::find($id);
        }elseif ($request->get('model_name') == 'Opportunity') {
            $modelFind = Opportunity::find($id);
        }else {

        }
        $modelFind->state = $state;
        $modelFind->save();
        // dd($logistic->state);

        // 返回响应结果并刷新页面
        return $this->response()->success("成功修改状态")->refresh();
    }

    // /**
    //  * 设置要POST到接口的数据
    //  *
    //  * @return array
    //  */
    public function parameters()
    {
        return [
            // 发送当前行 username 字段数据到接口
            'model_name' => $this->model_name,
            'state' => $this->model_state,
            // 把模型类名传递到接口
            // 'model' => $this->model,
        ];
    }
}
