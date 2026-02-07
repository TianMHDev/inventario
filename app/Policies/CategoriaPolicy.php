<?php

namespace App\Policies;

use App\Models\Categoria;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoriaPolicy
{
    /**
     * ¿Puede el usuario ver la lista de categorías?
     * Cualquiera autenticado puede verlas.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * ¿Puede ver el detalle de una categoría?
     */
    public function view(User $user, Categoria $categoria): bool
    {
        return true;
    }

    /**
     * ¿Puede crear categorías?
     * Solo Administradores.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * ¿Puede editar categorías?
     * Solo Administradores.
     */
    public function update(User $user, Categoria $categoria): bool
    {
        return $user->role === 'admin';
    }

    /**
     * ¿Puede borrar categorías?
     * Solo Administradores.
     */
    public function delete(User $user, Categoria $categoria): bool
    {
        return $user->role === 'admin';
    }
}
