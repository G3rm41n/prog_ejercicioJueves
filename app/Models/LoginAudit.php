<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginAudit extends Model
{
    /**
     * La tabla NO tiene las columnas created_at / updated_at que Laravel
     * agrega por defecto, así que las desactivamos.
     */
    public $timestamps = false;

    /**
     * Campos que se pueden asignar masivamente (mass assignment).
     * Estos son los que pasaremos al crear el registro.
     */
    protected $fillable = [
        'user_id',
        'ip_address',
        'logged_in_at',
    ];

    /**
     * Convierte logged_in_at a un objeto Carbon automáticamente,
     * lo que permite formatear la fecha fácilmente en las vistas.
     */
    protected $casts = [
        'logged_in_at' => 'datetime',
    ];

    /**
     * Relación: cada registro de auditoría pertenece a un Usuario.
     * Permite hacer: $audit->user->name
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
