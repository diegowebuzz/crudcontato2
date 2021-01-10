@extends("main")

@section("corpo")

<div class="d-block d-sm-none d-md-none d-lg-none">
    @include("partials.faixaTopoXS", ["titulo" => "Novo Contato"])
</div>

<div class="d-none d-sm-block">
    @include("partials.faixaTopoMd", ["titulo" => "Novo Contato", "rotuloBotao" => "Voltar Lista de Contatos"])
</div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <div style="border:1px solid black;" class="p-2">
                <div>
                    <label>Nome do Contato <i style="color:red" class="fas fa-asterisk"></i> </label>
                    <div> <input name="nome" id="nome" class="form-control form-control-sm"> </div>
                </div>


                <div>
                    <label>Celular <i style="color:red" class="fas fa-asterisk"></i> </label>
                    <input id="celular1" class="form-control form-control-sm celular">
                </div>

                <div id="camposNovos">

                </div>


                <div style="text-align:center" class="p-2">

                    <div> <button onclick="abrirJanelaNovoCampo()" class="btn btn-light"> adicionar novo campo </button> </div>

                </div>
                <div>
                    <div class="input-group">
                        <input id="cep" placeholder="digite o cep para inserir um endereço" class="form-control form-control-sm">

                        <div class="input-group-append">
                            <button onclick="autocompletarEndereco()" class="btn btn-primary btn-sm" type="button">buscar</button>
                        </div>
                    </div>
                </div>

                <div> <span>Logradouro:</span> <span id="logradouro"></span></div>
                <div> <span>bairro:</span> <span id="bairro"></span> </div>
                <div> <span>localidade:</span> <span id="localidade"></span> </div>

                <div> <span>uf:</span> <span id="uf"></span>
                    <div>

                        <div style="text-align:center" class="p-2">
                            <button onclick="salvarContato()" class="btn btn-success"> <i class="fa fa-check" aria-hidden="true"></i>
                                adicionar novo contato</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalNovoContato" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Novo Campo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div onclick="adicionarNovoCampo(event)" class="modal-body">

                        <div id="novoCelular"> Celular </div>
                        <div id="novoTelefoneFixo"> Telefone Fixo </div>
                        <div id="novoEmail">E-mail </div>

                    </div>

                </div>
            </div>
        </div>



        @section("scriptsPagina")

        <script>
           
           $(document).ready(function(){

               $('.celular').mask('00 00000-0000', null); //aplica a máscara para o celular que aparece quando a página é carrega inicialmente
               $('#cep').mask('00000-000', null); //aplica a máscara para o celular que aparece quando a página é carrega inicialmente

           });

         
            function abrirJanelaNovoCampo() {//exibi modal para o usuário adicionar novo compo de contato

                $('#modalNovoContato').modal();

            }

            function removerNovoCampo(event) {

                let idContainer = $(event.target).parent().prop('id');

                $('#camposNovos').find('#' + idContainer).remove();

            }

            function adicionarNovoCampo(event) {

                let tipoCampo = event.target.id;

                if (tipoCampo == "novoCelular") {

                    $("#camposNovos").append(`<div id='celular' style='position:relative'><label>celular</label><input  class='form-control celular'><span onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                    $('.celular').mask('00 00000-0000', null); //reaplica a máscara para todos os celulares, incluindo o recém criado

                }
                if (tipoCampo == "novoTelefoneFixo") {

                    $("#camposNovos").append(`<div id='telefone' style='position:relative' ><label>telefone </label><input class='form-control telefoneFixo'><span id="close1" onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                    $('.telefoneFixo').mask('00 0000-0000', null); //reaplica a máscara para todos os telefones, incluindo o recém criado

                }
                if (tipoCampo == "novoEmail") {

                    $("#camposNovos").append(`<div id='email' style='position:relative'  ><label>Email</label><input class='form-control email'><span id="close1" onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                }
                

                $('#modalNovoContato').modal('toggle');//fecha a modal

            }


            function salvarContato() {

               //antes de salvar verifica se o usuário inseriou pelo menos o nome e o celular

               $('#nome').removeClass("erro");
              $('#celular1').removeClass("erro");


                if ($('#nome').val() == '') {

                    $('#nome').addClass("erro");
                    return false;
                }
                if ($('#celular1').val() == '') {

                    $('#celular1').addClass("erro");
                    return false;
                }

                //pega referências as inputs para iterá-las 
                let inputsTelefones = $('.telefoneFixo');
                let inputsCelulares = $('.celular');
                let inputsEmails = $('.email');

                //as variáveis abaixo armezenaram os valores propriamente ditos
                let nome = $('#nome').val();
                let telefones = [];
                let celulares = [];
                let emails = [];
                var endereco = new Object();

                endereco.logradouro = $('#logradouro').text();
                endereco.bairro = $('#bairro').text();
                endereco.localidade = $('#localidade').text();
                endereco.uf = $('#uf').text();

               
               //itera as inputs para pegar os valores
                for (let i = 0; i < inputsTelefones.length; i++) {

                    telefones.push($(inputsTelefones[i]).val());

                }

                for (let i = 0; i < inputsCelulares.length; i++) {

                    celulares.push($(inputsCelulares[i]).val());

                }

                for (let i = 0; i < inputsEmails.length; i++) {

                    emails.push($(inputsEmails[i]).val());

                }


                $.ajax({
                    url: urlBackendAPI + 'contatos'
                    , method: 'POST'
                    , contentType: 'application/json; charset=utf-8',

                    data: JSON.stringify({
                        nome: nome
                        , celulares: celulares
                        , emails: emails
                        , telefones: telefones
                        , endereco: endereco
                    })
                    , success: function() {
                        window.location = "/contatos";
                    }
                });


            }

        </script>
        @stop

        @stop
