<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_account',
        'full_address',
        'street',
        'city',
        'state',
        'zip_code',
        'country'
    ];

    /**
     * Relación uno a muchos - Una dirección puede tener múltiples clientes
     */
    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    /**
     * Accessor para generar full_address automáticamente si está vacío
     */
    public function getFullAddressAttribute()
    {
        if (!empty($this->attributes['full_address'])) {
            return $this->attributes['full_address'];
        }

        $parts = array_filter([
            $this->street,
            $this->city,
            $this->state,
            $this->zip_code,
            $this->country
        ]);

        return implode(', ', $parts);
    }

    /**
     * Mutator para generar full_address automáticamente al guardar
     */
    public function setFullAddressAttribute($value)
    {
        if (empty($value)) {
            $parts = array_filter([
                $this->street,
                $this->city,
                $this->state,
                $this->zip_code,
                $this->country
            ]);
            $this->attributes['full_address'] = implode(', ', $parts);
        } else {
            $this->attributes['full_address'] = $value;
        }
    }
}