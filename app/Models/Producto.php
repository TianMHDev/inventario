<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
    /*
     |--------------------------------------------------------------------------
     | GLOBAL VARIABLES
     |--------------------------------------------------------------------------
     */

    // Nombre de la tabla en la base de datos
    protected $table = 'productos';

    // Nombre de la clave primaria
    protected $primaryKey = 'id';

    // Campos que se pueden llenar masivamente (Mass Assignment)
    // Esto permite usar Producto::create($request->all()) de forma segura
    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'user_id',
        'categoria_id',
        'imagen',
    ];

    // Conversión automática de tipos de datos al recuperar de la BD
    protected $casts = [
        'price' => 'decimal:2', // Asegura que el precio siempre tenga 2 decimales
        'stock' => 'integer',    // Asegura que el stock sea un número entero
    ];

    // protected $hidden = []; // Ocultar campos en JSON (ej: passwords)
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | CONSTANTS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
