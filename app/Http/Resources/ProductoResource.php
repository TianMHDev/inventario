<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'precio' => (float) $this->precio,
            'stock' => (int) $this->stock,
            // URL completa de la imagen almacenada.
            'imagen_url' => $this->imagen ? asset(\Illuminate\Support\Facades\Storage::url($this->imagen)) : null,
            // Información corta de la categoría relacionada.
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
            'vendedor' => [
                'id' => $this->user_id,
                'nombre' => $this->user->name ?? 'N/A',
            ],
            'fecha_registro' => $this->created_at->format('d/m/Y'),
        ];
    }
}
