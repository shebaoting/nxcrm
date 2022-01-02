<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use App\MyConfig;

class MyConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMyConfig();
    }

    protected function loadMyConfig()
    {
        // 获取配置
        $aliyun = json_decode(admin_setting_array('sms')['aliyun'], true);
        config([
            'easysms.gateways.aliyun' => $aliyun,
        ]);
    }
}
