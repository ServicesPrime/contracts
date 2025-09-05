<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service', // texto/nombre del servicio
        'type',    // string dinámico
    ];

    protected $casts = [
        'service' => 'string',
        'type'    => 'string',
    ];

    // (Opcional) expone automáticamente "type_label" en arrays/JSON
    protected $appends = ['type_label'];

    // ===== Relaciones =====
    public function specifications()
    {
        // Asegúrate de que service_specifications tenga FK 'service_id'
        return $this->hasMany(ServiceSpecification::class, 'service_id');
    }

    // ===== Accessors / Helpers =====
    public function getTypeLabelAttribute(): string
    {
        // Si tienes un mapeo en config/services.php => ['types' => ['service' => 'Service', ...]]
        $map = config('services.types', []); // o config('service_types', [])
        $value = (string) ($this->attributes['type'] ?? '');

        if (isset($map[$value])) {
            return (string) $map[$value];
        }

        // Fallback: capitaliza el string dinámico
        return $value !== '' ? ucfirst($value) : '';
    }

    // Normaliza a minúsculas y recorta espacios
    public function setTypeAttribute($value): void
    {
        $this->attributes['type'] = strtolower(trim((string) $value));
    }

    public function setServiceAttribute($value): void
    {
        $this->attributes['service'] = trim((string) $value);
    }

    // ===== Scopes =====
    public function scopeByType($query, string $type)
    {
        return $query->where('type', strtolower(trim($type)));
    }

    // Útil cuando aceptas varios tipos dinámicos
    public function scopeByTypes($query, array $types)
    {
        $types = array_map(fn ($t) => strtolower(trim((string) $t)), $types);
        return $query->whereIn('type', $types);
    }

    // Búsqueda sencilla por nombre o tipo
    public function scopeSearch($query, ?string $term)
    {
        if (! $term) return $query;

        $term = trim($term);
        return $query->where(function ($q) use ($term) {
            $q->where('service', 'like', "%{$term}%")
              ->orWhere('type', 'like', "%{$term}%");
        });
    }
}
