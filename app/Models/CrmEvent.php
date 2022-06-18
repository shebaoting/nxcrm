<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

class CrmEvent extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_events';

	public function CrmCustomer()
    {
        return $this->belongsTo(CrmCustomer::class);
    }

    public function adminUser()
    {
        return $this->belongsTo(Admin_user::class);
    }

    public function CrmContact()
    {
        return $this->belongsTo(CrmContact::class);
    }
}
