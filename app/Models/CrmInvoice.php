<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmInvoice extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'crm_invoices';
    protected $fillable = ['state'];
    public function CrmReceipt()
    {
        return $this->belongsTo(CrmReceipt::class);
    }
    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
