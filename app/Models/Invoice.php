<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasDateTimeFormatter;

    public function Receipt()
    {
        return $this->belongsTo(Receipt::class);
    }

}
