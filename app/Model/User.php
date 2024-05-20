<?php

// namespace App\Models;
require './app/Core/Model.php';
class User extends Model
{
    function __construct($table = 'tbladmin')
    {
        $this->table = $table;
    }

}
