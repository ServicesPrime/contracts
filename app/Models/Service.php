<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service',   // texto/nombre del servicio
        'type',      // enum: service|terms|area
    ];

    protected $casts = [
        'service' => 'string',
        'type'    => 'string',
    ];

    // ===== ENUM: Constantes =====
    const TYPE_SERVICE = 'service';
    const TYPE_TERMS   = 'terms';
    const TYPE_AREA    = 'area';

    // Opcional: mapa para etiquetas legibles
    public static function getTypes(): array
    {
        return [
            self::TYPE_SERVICE => 'Service',
            self::TYPE_TERMS   => 'Terms',
            self::TYPE_AREA    => 'Area',
        ];
    }

    // ===== Relaciones =====
    public function specifications()
    {
        // Asegúrate de que service_specifications tenga FK 'service_id'
        return $this->hasMany(ServiceSpecification::class, 'service_id');
    }

    // ===== Accessors / Helpers =====
    public function getTypeLabelAttribute(): string
    {
        $types = self::getTypes();
        return $types[$this->type] ?? ucfirst((string) $this->type);
    }

    public function isService(): bool
    {
        return $this->type === self::TYPE_SERVICE;
    }

    public function isTerms(): bool
    {
        return $this->type === self::TYPE_TERMS;
    }

    public function isArea(): bool
    {
        return $this->type === self::TYPE_AREA;
    }

    // Normaliza el tipo a minúsculas por consistencia
    public function setTypeAttribute($value): void
    {
        $this->attributes['type'] = strtolower((string) $value);
    }

    // ===== Scopes =====
    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function scopeService($query)
    {
        return $query->byType(self::TYPE_SERVICE);
    }

    public function scopeTerms($query)
    {
        return $query->byType(self::TYPE_TERMS);
    }

    public function scopeArea($query)
    {
        return $query->byType(self::TYPE_AREA);
    }
}
