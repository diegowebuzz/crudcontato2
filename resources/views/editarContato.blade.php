@extends("main")

@section("corpo")

<div class="d-block d-sm-none d-md-none d-lg-none">
    @include("partials.faixaTopoXS", ["titulo" => "Editar"])
</div>

<div class="d-none d-sm-block">
    @include("partials.faixaTopoMd", ["titulo" => "Editar do Contato", "rotuloBotao" => "Voltar Detalhes"])
</div>


<div class="container-fluid">
    <div class="row">

        <div class="col-md-4"></div>
        <div class="col-md-4">

            <div>
                <div> <label>Nome</label> </div>
                <input class="form-control" id="nome" name="name">
            </div>
            <div id="celulares">
            </div>

            <div id="telefones">
            </div>

            <div id="emails">
            </div>

            <div id="camposNovos"></div>

            <div style="text-align:center" class="p-2">

                <div> <button onclick="abrirJanelaNovoCampo()" class="btn btn-light"> adicionar novo campo </button> </div>

            </div>


            <div id="endereco">

                <div>
                    <div class="input-group">
                        <input id="cep" placeholder="digite o cep para inserir um endereço" class="form-control form-control-sm">

                        <div class="input-group-append">
                            <button onclick="autocompletarEndereco()" class="btn btn-primary btn-sm" type="button">buscar</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div> <span>Logradouro:</span> <span id="logradouro"></span></div>
                    <div> <span>bairro:</span> <span id="bairro"></span> </div>
                    <div> <span>localidade:</span> <span id="localidade"></span> </div>

                    <div> <span>uf:</span> <span id="uf"></span>
                        <div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button id="btnSalva" onclick="salvarAlteracoes()" class="btn btn-warning"> <i class="far fa-save"></i> salvar alterações </button>
                    </div>

                </div>
                <div class="col-md-4"></div>
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
        </div>
        @stop


        @section("scriptsPagina")

        <script>
          
            //obtem a query string id
            let searchParams = new URLSearchParams(window.location.search)
            let param = searchParams.get('id')


            $(document).ready(function() {

                //peda a id do contato na query string para redirecionar o usuário para os detalhes do contato, caso ele desista da atualização
                $('#btnFaixaTopo').prop("href", "/detalhes-contato?id=" + param);

                recuperarDadosContato();

            });

            function recuperarDadosContato() {

                $.ajax({

                    url: urlBackendAPI + "contatos/" + param
                    , method: 'GET'
                    , success: function(data) {

                        console.log(data);

                        $('#nome').val(data.nome);


                        $('#logradouro').text(data.enderecos.logradouro);
                        $('#bairro').text(data.enderecos.bairro);
                        $('#localidade').text(data.enderecos.localidade);
                        $('#uf').text(data.enderecos.uf);



                        for (let i = 0; i < data.telefones.length; i++) {

                            $("#camposNovos").append(`<div id='telefone' style='position:relative' ><label>telefone </label><input name='telefone' value="${data.telefones[i].numero}" class='form-control telefoneFixo'><span id="close1" onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);

                            $(".telefoneFixo").mask('00 0000-0000', null); //aplica a mascará na input inserida

                        }

                        for (let i = 0; i < data.celulares.length; i++) {


                            $("#camposNovos").append(`<div id='celular' style='position:relative'><label>celular</label><input name='celular' value="${data.celulares[i].numero}" class='form-control celular'><span onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                            $(".celular").mask('00 00000-0000', null); //aplica a mascará na input inserida
                        }

                        for (let i = 0; i < data.emails.length; i++) {

                            $(".email").append(`<div id='email' style='position:relative'  ><label>Email</label><input name='email' value="${data.emails[i].endereco}" class='form-control email'><span id="close1" onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);

                        }
                    }

                });

            }

            function salvarAlteracoes() {


                let nome = $('#nome').val();
                let endereco = new Object();
                let inputsTelefones = $('.telefoneFixo');
                let inputsCelulares = $('.celular');
                let inputsEmails = $('.email');
                let telefones = [];
                let celulares = [];
                let emails = [];

                endereco.logradouro = $('#logradouro').text();
                endereco.bairro = $('#bairro').text();
                endereco.localidade = $('#localidade').text();
                endereco.uf = $('#uf').text();


                for (let i = 0; i < inputsTelefones.length; i++) {

                    telefones.push($(inputsTelefones[i]).val());

                }

                for (let i = 0; i < inputsCelulares.length; i++) {

                    celulares.push($(inputsCelulares[i]).val());

                }

                for (let i = 0; i < inputsEmails.length; i++) {

                    emails.push($(inputsEmails[i]).val());

                }


                let data = {
                    nome: nome
                    , telefones: telefones
                    , celulares: celulares
                    , emails: emails
                    , endereco: endereco
                };


                $.ajax({
                    url: urlBackendAPI + "contatos/" + param
                    , method: 'POST'
                    , contentType: 'application/json; charset=utf-8',

                    data: JSON.stringify(data)
                    , success: function(data) {

                        window.location = "/detalhes-contato?id=" + param;

                    }
                });


            }

            function adicionarNovoCampo(event) {

                let tipoCampo = event.target.id;

                if (tipoCampo == "novoCelular") {

                    $("#camposNovos").append(`<div id='celular' style='position:relative'><label>celular</label><input  class='form-control celular'><span onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                    $('.celular').mask('00 00000-0000', null); //reaplica a máscara para todos os celulares, incluindo o recém criado

                }
                if (tipoCampo == "novoTelefoneFixo") {

                    $("#camposNovos").append(`<div id='telefone' style='position:relative' ><label>telefone </label><input class='form-control telefoneFixo'><span id="close1" onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                    $('.tefone').mask('00 0000-0000', null); //reaplica a máscara para todos os telefones, incluindo o recém criado

                }
                if (tipoCampo == "novoEmail") {

                    $("#camposNovos").append(`<div id='email' style='position:relative'  ><label>Email</label><input class='form-control email'><span id="close1" onclick='removerNovoCampo(event)' style='position:absolute;right:0px; top:2px;'>dispensar</span></div>`);
                }


                $('#modalNovoContato').modal('toggle'); //fecha a modal

            }

            function abrirJanelaNovoCampo() { //exibi modal para o usuário adicionar novo compo de contato

                $('#modalNovoContato').modal();

            }

            function removerNovoCampo(event) {

                let idContainer = $(event.target).parent().prop('id');

                $('#camposNovos').find('#' + idContainer).remove();

            }

        </script>

        @stop
