<?php

namespace App\Services;

use App\Admin\Contracts\SettingsContract;
use App\Models\Setting;

class SettingsService extends SettingsContract
{
    protected  $setting;

    function __construct(Setting $setting)
    {
        $this->setting = $setting;
    }

    function all()
    {
        return $this->setting->all(['key', 'value'])->pluck('value', 'key')->toArray();//https://learnku.com/docs/laravel/5.5/collections#method-pluck
    }

    function set($key, $value) {
        $this->isRefresh = true;

        if ($value === null) {
            $this->setting->where('key', $key)->delete();
        } else {
            $this->setting->updateOrCreate(compact('key'), compact('value'));
        }

        parent::set( $key , $value );

    }

    function delete($key) {
        $this->isRefresh = true;

        $this->setting->where('key', $key)->delete();
        parent::delete($key);
    }

}