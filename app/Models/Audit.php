<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Audit as AuditTrait;
use OwenIt\Auditing\Contracts\Audit as AuditContract;

class Audit extends Model implements AuditContract
{
    use HasFactory;
    use AuditTrait;

    protected $guarded = [];

    protected $casts = [
        'old_values' => 'json',
        'new_values' => 'json'
    ];

    /**
     * Accesors
     */
    public function getTypeNameAttribute()
    {
        $auditableType = class_basename($this->auditable_type);

        // Get types
        $types = config('admin.audit.types');

        // Return type name
        return isset($types[$auditableType]) ? $types[$auditableType] : 'Indefinido';
    }

    public function getActionNameAttribute()
    {
        // Get actions
        $actions = config('admin.audit.actions');

        // Return action name
        return $actions[$this->event];
    }
}
