<?php

namespace App\Models\Ekanban;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Ekanban_user_tbl extends Authenticatable
{
    protected $connection = 'ekanban';
    protected $table = 'ekanban_user_tbl';

    protected $fillable = [
        'id', 'user', 'pass', 'group',
    ];

    protected $hidden = [
        'pass',
    ];

    // The password field name in your table
    public function getAuthPassword()
    {
        return $this->pass;
    }

    public $timestamps = false;
}
