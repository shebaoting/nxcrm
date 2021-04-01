<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CrmContract;
use Dcat\Admin\Admin;

class CrmMyContracts extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */
    protected $footer;

    // 保存自定义参数
    protected $data = [];

    // 构造方法参数必须设置默认值
    public function __construct(array $data = [])
    {
        $this->data = [];

        parent::__construct();
    }

    protected function init()
    {
        parent::init();

        // 设置标题
        $this->title('我的合同');
        // 设置下拉菜单
        $contract = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        });
        $this->contract_num = $contract->count();
    }

    /**
     * 处理请求.
     *
     * @param Request $request
     *
     * @return void
     */
    public function handle()
    {
                $this->content($this->contract_num);
                $this->up($this->grow());
    }

    // 传递自定义参数到 handle 方法
    public function parameters() : array
    {
        return $this->data;
    }

    /**
     * @param int $percent
     *
     * @return $this
     */
    public function up($percent)
    {
        return $this->footer(
            "<i class=\"feather icon-trending-up text-primary\"></i> {$percent}%"
        );
    }

    /**
     * 设置卡片底部内容
     *
     * @param string|Renderable|\Closure $footer
     *
     * @return $this
     */
    public function footer($footer)
    {
        $this->footer = $footer;

        return $this;
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function renderContent()
    {
        $content = parent::renderContent();

        return <<<HTML
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
    <h2 class="ml-1 font-large-1">{$content}</h2>
</div>
<div class="ml-1 mt-1">
    <span class=" font-weight-bold text-primary">{$this->renderFooter()}</span><span class="text-secondary"> 月环比</span>
</div>
HTML;
    }

    /**
     * @return string
     */
    public function renderFooter()
    {
        return $this->toString($this->footer);
    }


    /**
     * 月环比.
     */

    public function grow (){
        $origin = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereMonth('signdate', date('m'))
        ->get();

        $last_month = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereMonth('signdate', date('m',strtotime("-1 month")))
        ->get();


       $grow = round(($origin->count() - $last_month->count()) / $last_month->count() * 100);


        return $grow;
     }
}
