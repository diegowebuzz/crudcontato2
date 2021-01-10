<?php

namespace App\Repositorios;


interface ContatosRepositorio
{
    public function recuperarContatos($nomepesquisa);

    public function adicionarContato($atributos);
     
    public function recuperarContato($id);

    public function removerContato($id);

    public function atualizarContato($id, $atributos);



}