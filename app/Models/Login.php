<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as BasicAuthenticatable;
class Login extends Model implements Authenticatable

{
    use HasFactory;
    use BasicAuthenticatable;


    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
    ];
    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->{$this->password()};
    }
}

