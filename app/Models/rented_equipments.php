<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rented_equipments extends Model
{
    use HasFactory;

    public $table="rented_equipments";
    public $timestamps = false;
}
