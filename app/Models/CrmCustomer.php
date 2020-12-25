<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Traits\HighSeas;

class CrmCustomer extends Model
{
	use HasDateTimeFormatter,HighSeas;

    protected $table = 'crm_customers';

	public function CrmContacts()
    {
        return $this->hasMany(CrmContact::class);
    }

    public function CrmContracts()
    {
        return $this->hasMany(CrmContract::class);
    }

    public function Admin_user()
    {
        return $this->belongsTo(Admin_user::class);
    }

    public function CrmEvents()
    {
        return $this->hasMany(CrmEvent::class);
    }
    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function CrmOpportunitys()
    {
        return $this->hasMany(CrmOpportunity::class);
    }

    public function SharesUser()
    {
        return $this->belongsToMany(Admin_user::class, 'crm_shares', 'crm_customer_id', 'user_id');
    }
}
