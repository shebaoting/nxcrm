<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmOpportunity extends Model
{
    use HasDateTimeFormatter;
    protected $table = 'crm_opportunitys';

    public function CrmCustomer()
    {
        return $this->belongsTo(CrmCustomer::class);
    }

    public function CrmEvents()
    {
        return $this->hasMany(CrmEvent::class);
    }

    public function Attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
