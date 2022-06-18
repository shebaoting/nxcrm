<?php

namespace App\Admin\RowAction;

use Dcat\Admin\Grid\RowAction;
use Illuminate\Http\Request;
use App\Models\CrmCustomer;
use Dcat\Admin\Admin;

class ReceiveHighSeas extends RowAction
{
    protected $model;

    public function __construct(array $model = [])
    {
        $this->model_title = $model[0] ?? null;
        $this->model_info = $model[1] ?? null;
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

        // 改变状态
        $modelFind = CrmCustomer::find($id);
        $modelFind->admin_user_id = $modelFind->admin_user_id ? 0 : Admin::user()->id;
        $modelFind->save();

        // 返回响应结果并刷新页面
        return $this->response()->success("您的操作已成功")->refresh();
    }
}
