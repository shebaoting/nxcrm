<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Setting;
use Dcat\Admin\Widgets\Card;
use Dcat\Admin\Layout\Content;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('网站设置')
            ->description('详情')
            ->body(new Card(new Setting()));
    }

}