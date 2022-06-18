<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmProgram extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_programs';
    
}
