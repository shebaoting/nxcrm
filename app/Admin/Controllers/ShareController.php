<?php

namespace App\Admin\Controllers;

use App\Models\CrmCustomer;
use Illuminate\Http\Request;
use Dcat\Admin\Http\Controllers\AdminController;

class ShareController extends AdminController
{
    public function sharestore(Request $request){
        $user = explode(",",$request['user']);
        CrmCustomer::find($request['customer'])->SharesUser()->sync($user, true);
        return redirect('admin/customers/' . $request['customer']);
    }
}
