<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmProduct extends Model
{
	use HasDateTimeFormatter;
    protected $table = 'crm_products';

}
