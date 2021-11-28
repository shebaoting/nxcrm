<?php
namespace App\Models;

use Dcat\Admin\Models\Administrator;

class Admin_user extends Administrator
{
    public function CrmCustomers()
    {
        return $this->hasMany(CrmCustomer::class,'admin_user_id');
    }

    public function CrmEvents()
    {
        return $this->hasMany(CrmEvent::class,'admin_user_id');
    }

    public function CrmContracts()
    {
        return $this->hasManyThrough(CrmContract::class,'App\Models\CrmCustomer','admin_user_id','crm_customer_id');
    }

    public function SharesCustomer()
    {
        return $this->belongsToMany(CrmCustomer::class, 'crm_shares', 'user_id', 'crm_customer_id');
    }

}
