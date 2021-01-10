<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    protected $fillable = array('nome', 'created_at', 'updated_at');
    protected $table = 'contato';
    //protected $hidden = ['id'];

    
    public function telefones()
    {
        return $this->hasMany(Telefone::class, 'id_contato', 'id');
    }
    public function celulares()
    {
        return $this->hasMany(Celular::class, 'id_contato', 'id');
    }
    public function emails()
    {
        return $this->hasMany(Email::class, 'id_contato', 'id');
    }
    public function enderecos()
    {
        return $this->hasOne(Endereco::class, 'id_contato', 'id');
    }

}
