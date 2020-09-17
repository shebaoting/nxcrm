<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Admin;
use Dcat\Admin\Widgets\Metrics\Bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Customers extends Bar
{

    /**
     * 初始化卡片内容
     */
    protected function init()
    {
        parent::init();


        $this->height(166.39);
        $this->chartHeight(70);

        $color = Admin::color();

        $dark35 = $color->dark35();

        // 卡片内容宽度
        $this->contentWidth(5, 6);
        // 标题
        $this->title('客户数');
        // 设置下拉选项
        // 设置图表颜色

        $customer = DB::table('customers')->where('state', '=', 3);
        $this->customer_num = $customer->count();
        $this->num = $customer->selectRaw('DATE_FORMAT(created_at,"%Y-%m") as date,COUNT(*) as value')->groupBy('date')->limit(12)->get();
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

        // 卡片内容
        $this->withContent($this->customer_num, $this->grow());
        // 图表数据
        $this->withChart([
            [
                'name' => '月增长',
                'data' => array_column($this->num->toArray(), 'value'),
            ],
        ]);
    }

    /**
     * 设置图表数据.
     *
     * @param array $data
     *
     * @return $this
     */
    public function withChart(array $data)
    {
        return $this->chart([
            'series' => $data,
            'xaxis' => [
                'categories' => array_column($this->num->toArray(), 'date')
            ],
            'tooltip' => [
                'x' => ['show' => true],
            ]
        ]);
    }

    /**
     * 设置卡片内容.
     *
     * @param string $title
     * @param string $value
     * @param string $style
     *
     * @return $this
     */
    public function withContent($title, $value, $style = 'primary')
    {
        // 根据选项显示
        return $this->content(
            <<<HTML
<div class="d-flex p-1 flex-column justify-content-between">
    <div class="text-left">
        <h1 class="ml-1 font-lg-1">{$title}</h1>
        <h5 class="font-medium-2 ml-1" style="margin-top: 10px;">
            <span class="text-{$style}">{$value}%</span>
        </h5>
    </div>
</div>
HTML
        );
    }


    /**
     * 月环比.
     */

     public function grow (){
        $origin = DB::table('customers')->selectRaw('DATE_FORMAT(created_at,"%Y-%m") as date,COUNT(*) as value')
        ->whereMonth('created_at', date('m'))
        ->groupBy('date')
        ->get()
        ->toArray();

        $last_month = DB::table('customers')->selectRaw('DATE_FORMAT(created_at,"%Y-%m") as date,COUNT(*) as value')
        ->whereMonth('created_at', date('m',strtotime("-1 month")))
        ->groupBy('date')
        ->get()
        ->toArray();

        if ($last_month && $origin) {
            $grow = round(($origin[0]->value - $last_month[0]->value) / $last_month[0]->value * 100);
        } elseif (empty($last_month) && $origin) {
            $grow = $origin[0]->value * 100;
        }elseif  (empty($origin) && $last_month) {
            $grow = round((0 - $last_month[0]->value) / $last_month[0]->value * 100);
        } else {
            $grow = 0;
        }

        return $grow;
     }


}
