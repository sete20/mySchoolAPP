<?php

namespace App\Http\Requests\Concerns;

use Illuminate\Support\Facades\Hash;

trait WithHashedPassword
{
    /**
     * Get all of the input and files for the request and hash password if exists.
     *
     * @return array
     */
    public function allWithHashedPassword()
    {
        if ($password = $this->input('password')) {
            return array_merge(
                $this->except(['_token', 'image', 'password_confirmation']),
                ['password' => Hash::make($password)]
            );
        }
        return $this->except('password');
    }
    public function updateAllWithHashedPassword()
    {
        if ($password = $this->input('password')) {
            return array_merge(
                $this->except(['_token', 'image', 'password_confirmation', 'email', 'phone']),
                ['password' => Hash::make($password)]
            );
        }
        return $this->except('password');
    }
}
