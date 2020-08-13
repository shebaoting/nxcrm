<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
	use HasDateTimeFormatter;

	public function Contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
