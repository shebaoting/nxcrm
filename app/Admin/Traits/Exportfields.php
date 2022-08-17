<?php

namespace App\Admin\Traits;

use Dcat\Admin\Grid;
use App\Models\CrmCustomer;

trait Exportfields
{
    protected function Exportfield(Grid $grid, $modelname)
    {

        switch ($modelname) {
            case 'customer':
                $top_titles = ['id' => 'ID', 'name' => '名称', 'admin_user_id' => '所属销售', 'address' => '地址'];
                $detaname = 'CrmCustomer';
                break;
            case 'contract':
                $top_titles = ["title" => "合同名称", "crm_customer_id" => "所属客户", "signdate" => "开始日期", "expiretime" => "到期时间", "total" => "合同总额", "remark" => "合同备注"];
                $detaname = 'CrmContract';
                break;
            case 'contact':
                $top_titles = ["name" => "联系人名称", "phone" => "电话", "crm_customer_id" => "所属客户"];
                $detaname = 'CrmContact';
                break;
            default:
                $top_titles = [];
        }

        // 将自定义字段加入导出列的数组
        foreach ($this->custommodel($modelname) as $field) {
            $top_titles[$field['field']] = $field['name'];
        }
        
        $grid->export($top_titles)->rows(function ($rows) use ($modelname) {

            foreach ($rows as $index => &$row) {
                $customer_fields = json_decode($row['fields'], true);
                foreach ($this->custommodel($modelname) as $field) {
                    $field_options = json_decode($field['options'], true);

                    if (in_array($field['type'], ['select', 'radio'])) {
                        $row[$field['field']] = (isset($customer_fields[$field['field']])) ? $field_options[$customer_fields[$field['field']]] : '';
                    } elseif (in_array($field['type'], ['checkbox', 'multipleSelect'])) {
                        foreach ($customer_fields[$field['field']] as $key => $value) {
                            $row[$field['field']] = $value ? $field_options[$value] : '';
                        }
                    } else {
                        $row[$field['field']] = (isset($customer_fields[$field['field']])) ? $customer_fields[$field['field']] : '';
                    }
                }
            }
            return $rows;
        });
    }
}
