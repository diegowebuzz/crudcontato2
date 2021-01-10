<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table = 'email';
    public $timestamps = false;
    protected $hidden = ['id_contato'];



    protected $fillable = array('id_contato', 'endereco');

    
}
