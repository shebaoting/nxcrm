<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasDateTimeFormatter;
    protected $fillable = ['state'];
    public function Receipt()
    {
        return $this->belongsTo(Receipt::class);
    }
    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }
}
