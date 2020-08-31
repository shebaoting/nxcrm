<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Opportunitys_all extends Round
{
    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();

        $this->title('商机');
        $this->height(450);
        $this->chartHeight(350);
        $this->chartLabels(['被拒绝', '已成功', '跟进中']);
        $opportunitys = DB::table('opportunitys');
        $this->opportunitys_num = $opportunitys->count();
        $this->num = $opportunitys->selectRaw('state,COUNT(*) as value')->groupBy('state')->get();

    }

    /**
     * 处理请求
     *
     * @param Request $request
     *
     * @return mixed|void
     */
    public function handle(Request $request)
    {
        if ($this->num->count()) {
        $count = (array_column($this->num->toArray(), 'value'));
        }else {
        $count = [0, 0, 0];
        }
        // 卡片内容
        $this->withContent($count);

        // 图表数据
        $this->withChart($count);

        // 总数
        $this->chartTotal('总数', $this->opportunitys_num);
        $this->contentWidth(1,10,1);
    }

    /**
     * 设置图表数据.
     *
     * @param int $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => $data,
        ]);
    }



    /**
     * 卡片底部内容.
     *
     * @param string $new
     * @param string $open
     * @param string $response
     *
     * @return $this
     */
    public function withContent($count)
    {
        return $this->footer(
            <<<HTML
<div class="d-flex justify-content-between p-1" style="padding-top: 0!important;">
    <div class="text-center">
        <p>已完成</p>
        <span class="font-lg-1">{$count[1]}</span>
    </div>
    <div class="text-center">
        <p>等待中</p>
        <span class="font-lg-1">{$count[2]}</span>
    </div>
    <div class="text-center">
        <p>被拒绝</p>
        <span class="font-lg-1">{$count[0]}</span>
    </div>
</div>
HTML
        );
    }
}
