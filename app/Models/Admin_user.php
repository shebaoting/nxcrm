<?php
namespace App\Models;
use Dcat\Admin\Models\Administrator;

class Admin_user extends Administrator
{
    public function Customers()
    {
        return $this->hasMany('App\Models\Customer','admin_users_id');
    }

    public function Contracts()
    {
        return $this->hasManyThrough('App\Models\Contract','App\Models\Customer','admin_users_id','customer_id');
    }

    public function shares_Customer()
    {
        return $this->belongsToMany('App\Models\Customer', 'shares', 'user_id', 'customer_id');
    }

}
