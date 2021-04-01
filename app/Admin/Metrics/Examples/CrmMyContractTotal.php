<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Dcat\Admin\Admin;
use App\Models\CrmContract;

class CrmMyContractTotal extends Card
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
        $this->title('本月业绩总额');
        $this->header('我本月签署的合同总额...');
        // 设置下拉菜单
        $this->ContractTotal = CrmContract::whereHas('CrmCustomer', function ($query) {
            $query->where('admin_user_id', Admin::user()->id);
        })->whereYear('signdate', date('Y'))
        ->whereMonth('signdate', date('m'))->sum('total');
        // dd($ContractTotal);
        $this->month = date("Y年m月");
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
        $this->content('￥' . intval($this->ContractTotal));
        $this->up($this->month);
    }

    // 传递自定义参数到 handle 方法
    public function parameters(): array
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
            "{$percent}"
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
<div class="row">
<div class="col-6">
<div class="d-flex justify-content-between align-items-center mt-1" style="margin-bottom: 2px">
<p class="mb-0 ml-1" style="font-size: 24px;"><b class="text-primary">{$content}</b></p>
</div>
</div>

<div class="col-6">
<img src="static/img/work.png" alt="image" style="position: absolute;right: 40px;top: -50px;height: 135px;">
</div>
</div>
<div class="ml-1 mt-1">
    <span>{$this->renderFooter()}</span>
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
}
