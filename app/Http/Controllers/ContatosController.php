<?php

namespace App\Http\Controllers;

use App\Models\Celular;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

use App\Models\Contato;
use App\Models\Email;
use App\Models\Endereco;
use App\Models\Telefone;
use App\Repositorios\ContatosRepositorio;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use stdClass;

class ContatosController extends BaseController
{

   private $contatoRepositorio;

     public function __construct(ContatosRepositorio $contatoRepositorio){

       $this->contatoRepositorio = $contatoRepositorio;

     }

        function recuperarContatos(Request $request){
            
         $nomePesquisa = $request->nomePesquisa;
              
         return $this->contatoRepositorio->recuperarContatos($nomePesquisa);

      }


      function recuperarContato(Request $request){


       return $this->contatoRepositorio->recuperarContato($request->id);

      }

      function adicionarContato(Request $request){
        
        
         $atributos = [];

         $atributos["nome"] = $request->nome;
         $atributos["telefones"] = $request->telefones;
         $atributos["telefones"] = $request->telefones;
         $atributos["celulares"] = $request->celulares;
         $atributos["emails"] = $request->emails;
         $atributos["endereco"] = $request->endereco;

         $this->contatoRepositorio->adicionarContato($atributos);
       

      }

      function atualizarContato(Request $request){

     
          $atributos = [];

          $atributos["nome"] = $request->nome;
          $atributos["telefones"] = $request->telefones;
          $atributos["telefones"] = $request->telefones;
          $atributos["celulares"] = $request->celulares;
          $atributos["emails"] = $request->emails;
          $atributos["endereco"] = $request->endereco;
     
            $this->contatoRepositorio->atualizarContato($request->id, $atributos);
       


      }


      function removerContato(Request $request){


            $this->contatoRepositorio->removerContato($request->id);


   }
}