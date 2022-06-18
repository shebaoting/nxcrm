<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class CrmModelcontract extends Model
{
	use HasDateTimeFormatter;
    protected $fillable = ['id', 'title'];
    protected $table = 'crm_modelcontract';

}
