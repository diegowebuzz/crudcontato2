<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $table = 'telefone';
    public $timestamps = false;
    protected $hidden = ['id_contato'];



    protected $fillable = array('id_contato', 'numero');

}
