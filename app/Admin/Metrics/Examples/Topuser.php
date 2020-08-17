<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Admin_user as user;

class TopUser extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */

    protected function init()
    {
        parent::init();
        $this->height(450);
        // 设置标题
        $this->title('最佳表现');
        $users = user::select(['id', 'name','avatar'])->withCount(['customers' => function (Builder $query) {
            $query->where('state', '=', '3');
        },'customers as Leads_count' => function (Builder $query) {
            $query->where('state', '<>', '3');
        },'contracts'])->get();
        $this->withContent(view('admin.metrics.examples.topuser',compact('users')));
    }

    /**
     * 渲染卡片内容.
     *
     * @return string
     */
    public function withContent($content)
    {
        return $this->content(
            <<<HTML
            {$content}</h1>
HTML
        );
    }
}
