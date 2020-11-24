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
        return $this->setting->all(['slug', 'value'])->pluck('value', 'slug')->toArray();//https://learnku.com/docs/laravel/5.5/collections#method-pluck
    }

    function set($slug, $value) {
        $this->isRefresh = true;

        if ($value === null) {
            $this->setting->where('slug', $slug)->delete();
        } else {
            $this->setting->updateOrCreate(compact('slug'), compact('value'));
        }

        parent::set( $slug , $value );

    }

    function delete($slug) {
        $this->isRefresh = true;

        $this->setting->where('slug', $slug)->delete();
        parent::delete($slug);
    }

}
