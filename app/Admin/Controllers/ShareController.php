<?php

namespace App\Admin\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Dcat\Admin\Http\Controllers\AdminController;

class ShareController extends AdminController
{
    public function sharestore(Request $request){
        $user = explode(",",$request['user']);
        Customer::find($request['customer'])->shares_user()->sync($user, true);
        return redirect('admin/customers/' . $request['customer']);
    }
}
