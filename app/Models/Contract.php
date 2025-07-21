<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


   class Contract extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'client_id',
        'department',
        'service_id',
        'product_quantity',
        'product_cost',
        'date'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}

