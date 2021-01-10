<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{

    protected $table = 'endereco';
    public $timestamps = false;
    protected $hidden = ['id_contato'];



    protected $fillable = array('id_contato', 'logradouro', 'bairro', 'uf', 'localidade');

}
