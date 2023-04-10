<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Notifications\VerifyEmailQueued;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Auth\Notifications\VerifyEmail;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use App\Jobs\SendEmailVerificationNotification;


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
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email:dns',
                'max:255',
                Rule::unique(User::class),
            ],
            'alamatpemohon' => 'required|max:255',
            'nohp' => 'required|max:20',
            'password' => $this->passwordRules(),
        ])->validate();

        
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'alamatpemohon' => $input['alamatpemohon'],
            'nohp' => $input['nohp'],
            'password' => Hash::make($input['password']),
        ]);

        // VerifyEmail::dispatch($user);
        SendEmailVerificationNotification::dispatch($user);
        
        return $user;
    }
}