<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmReceipt extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_receipts';

	public function CrmContract()
    {
        return $this->belongsTo(CrmContract::class);
    }

    public function CrmInvoice()
    {
        return $this->hasOne(CrmInvoice::class);
    }
}
