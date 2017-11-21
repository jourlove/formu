<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    protected $table = "admins";

    public function isSupperAdmin()
    {
        return $this->authorization === 'superadmin';
    }
}
