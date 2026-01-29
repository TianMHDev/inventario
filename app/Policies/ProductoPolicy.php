<?php

namespace App\Policies;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductoPolicy
{
    /**
     * ¿Puede el usuario ver la lista general?
     * Retornamos true porque el filtrado real se hace en el Controlador.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * ¿Puede ver un producto específico?
     * Regla: Solo si es Admin O si es el dueño del producto.
     */
    public function view(User $user, Producto $producto): bool
    {
        return $user->role === 'admin' || $user->id === $producto->user_id;
    }

    /**
     * ¿Puede crear productos?
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * ¿Puede editar?
     * Regla: Solo si es Admin O si es el dueño.
     */
    public function update(User $user, Producto $producto): bool
    {
        return $user->role === 'admin' || $user->id === $producto->user_id;
    }

    /**
     * ¿Puede borrar?
     * Regla: Solo si es Admin O si es el dueño.
     */
    public function delete(User $user, Producto $producto): bool
    {
        return $user->role === 'admin' || $user->id === $producto->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Producto $producto): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Producto $producto): bool
    {
        return $user->role === 'admin';
    }
}
