<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;


class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // VALIDACIÓN: Definimos las reglas para los nuevos campos
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                // Regla personalizada: Solo correos corporativos
                function ($attribute, $value, $fail) {
                    if (!str_ends_with($value, '@empresa.com')) {
                        $fail('Solo se aceptan correos corporativos (@empresa.com).');
                    }
                }
            ],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            // Validación de Rol: Solo puede ser admin o empleado
            'role' => ['nullable', 'string', 'in:admin,empleado'],
            // Validación de Edad: Debe ser número y >= 18
            'edad' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) {
                    if ($value < 18) {
                        $fail('Debes ser mayor de edad');
                    }
                }
            ],
        ])->validate();

        // CREACIÓN: Insertamos el registro en la tabla 'users'
        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'] ?? 'empleado', // Si no se envía el rol, por defecto es empleado
            'edad' => $input['edad'],
        ]);
    }
}
