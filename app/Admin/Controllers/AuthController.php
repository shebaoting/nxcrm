<?php

namespace App\Admin\Controllers;

use Dcat\Admin\Layout\Content;

use Dcat\Admin\Http\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{

    public function getLogin(Content $content)
    {
        if ($this->guard()->check()) {
            return redirect($this->getRedirectPath());
        }
        if (admin_setting('logintheme', 'bigpicture') == 'bigpicture'){
            $logintheme = 'admin.login.login';
        } else {
            $logintheme = $this->view;
        }
        return $content->full()->body(view($logintheme));
    }
}
