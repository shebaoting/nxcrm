<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmCustomfield extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_customfields';
    public $timestamps = false;
}
