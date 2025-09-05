<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'page_count',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
