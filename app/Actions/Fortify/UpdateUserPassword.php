<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Illuminate\Support\Facades\DB;
use PasswordValidationRules;

class UpdateUserPassword implements UpdatesUserPasswords
{


    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {

        Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'password' => $this->passwordRules(),
        ], [
            'current_password.current_password' => __('La contraseña introducia no coincide con la contraseña registrada'),
        ])->validateWithBag('updatePassword');

        $user->fill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
