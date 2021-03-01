<?php

namespace App\Admin\Traits;

use App\Models\CrmCustomfield;

trait Importfields
{

    protected function custommodel($modelname)
    {
        $fields = CrmCustomfield::where([['model', '=', $modelname], ['show', '=', '1']])->orderBy('sort', 'desc')->get();
        // return dd($fields);
        return $fields;
    }

    protected function Importfield($modelname)
    {
        $customer = ["name"=>"客户名称"];
        $contract = ["title"=>"合同名称","crm_customer_id"=>"所属客户","signdate"=>"开始日期","expiretime"=>"到期时间","total"=>"合同总额","remark"=>"合同备注"];
        $contact = ["name"=>"联系人名称","phone"=>"电话","crm_customer_id"=>"所属客户"];
        foreach ($this->custommodel($modelname) as $k => $v) {
            $$modelname['fields'][$this->custommodel($modelname)[$k]['field']] = $this->custommodel($modelname)[$k]['name'];
        }
        return $$modelname;
    }
}
