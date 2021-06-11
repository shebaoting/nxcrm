<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;
use App\Admin\Traits\HighSeas;

class CrmCustomer extends Model
{
	use HasDateTimeFormatter,HighSeas;

    protected $table = 'crm_customers';
    protected $fillable = ['admin_user_id'];

	public function CrmContacts()
    {
        return $this->hasMany(CrmContact::class);
    }

    public function CrmContracts()
    {
        return $this->hasMany(CrmContract::class);
    }

    public function adminUser()
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

    public function crmReceipts()
    {
        return $this->hasManyThrough(CrmReceipt::class, CrmContract::class);
    }

    public function crmInvoice()
    {
        return $this->hasManyThrough(CrmInvoice::class, CrmContract::class);
    }

    public function crmOrders()
    {
        return $this->hasManyThrough(CrmOrder::class, CrmContract::class);
    }
}
