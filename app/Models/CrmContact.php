<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmContact extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_contacts';
    public $timestamps = false;
    protected $fillable = [
        'name', 'phone'
    ];
    public function CrmCustomer()
    {
        return $this->belongsTo(CrmCustomer::class);
    }

}
