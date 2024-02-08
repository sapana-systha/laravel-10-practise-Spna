<?php

namespace App\Models;

use Illuminate\Database\Events\ModelsPruned;

class Book extends ModelsPruned{
    protected $table='my-books';
}