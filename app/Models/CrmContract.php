<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmContract extends Model
{
	use HasDateTimeFormatter;
    public $timestamps = false;

    public function CrmReceipts()
    {
        return $this->hasMany(CrmReceipt::class);
    }

    public function CrmOrders()
    {
        return $this->hasMany(CrmOrder::class);
    }

    public function CrmCustomer()
    {
        return $this->belongsTo(CrmCustomer::class);
    }

    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public function CrmEvents()
    {
        return $this->hasMany(CrmEvent::class);
    }

    public function CrmInvoices()
    {
        return $this->hasMany(CrmInvoice::class);
    }
}
