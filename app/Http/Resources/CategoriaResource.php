<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * Recurso para transformar el modelo Categoria en una respuesta JSON estandarizada.
 */
class CategoriaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            // Generamos la URL completa para la imagen si existe.
            'imagen_url' => $this->imagen ? asset(Storage::url($this->imagen)) : null,
            'fecha_creacion' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
