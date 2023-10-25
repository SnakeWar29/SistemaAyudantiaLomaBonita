<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\ResetsUserPasswords;
use Laravel\Fortify\PasswordValidationRules;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
class ResetUserPassword implements ResetsUserPasswords
{


    /**
     * Validate and reset the user's forgotten password.
     *
     * @param  array<string, string>  $input
     */
    public function reset(User $user, array $input): void
    {

        $user->forceFill([
            'password' => Hash::make($input['password']),
        ])->save();
    }
}
