<?php

namespace App\Admin\Metrics\Examples;

use Dcat\Admin\Widgets\Metrics\Card;

class Adver extends Card
{
    /**
     * 卡片底部内容.
     *
     * @var string|Renderable|\Closure
     */

    protected function init()
    {
        parent::init();
        // 设置标题
        $this->withContent(view('admin.metrics.examples.adver'));
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
