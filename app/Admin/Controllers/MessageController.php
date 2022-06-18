<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Http\JsonResponse;
use Dcat\Admin\Admin;
use App\Models\Admin_user;


class MessageController extends Controller
{
    public function show($id)
    {
        $notification = Admin_user::findOrFail(Admin::user()->id)->unreadNotifications()->where('id', $id)->first();
        if ($notification) {
            $notification->markAsRead();
            return admin_redirect('contracts/'.$notification->data['contract_id']);
        }
    }

    public function showAll()
    {
        Admin_user::findOrFail(Admin::user()->id)->unreadNotifications->markAsRead();
        return JsonResponse::make()->success('操作成功')->location();;
    }
}
