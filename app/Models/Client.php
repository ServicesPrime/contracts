<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'address_id',
        'name',
        'phone',
        'email',
        'area'
    ];

    /**
     * Relación inversa - Un cliente pertenece a una dirección
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Scope global para cargar siempre la dirección
     */
    protected static function booted()
    {
        static::addGlobalScope('with-address', function ($query) {
            $query->with('address');
        });
    }
}