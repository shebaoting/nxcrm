<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
	use HasDateTimeFormatter;

	public function contract()
    {
        return $this->belongsTo(contract::class);
    }
}
