@extends("main")

@section("corpo")
<div>
    <div class="p-4 bg-primary d-none d-sm-block">
        <div>
            <a class="btn btn-success" href="/criar-contato">Adicionar Novo Contato</a>
        </div>
    </div>


    <div class="d-block d-sm-none d-md-none d-lg-none text-center bg-primary">
        <span style="font-size:30px;color:white;">Contatos</span>
    </div>
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-5">
                    <div class="mb-2 bg-primary d-block">
                        <div class="input-group p-2 bg-light">
                            <input id="nome" placeholder="digite um nome para pesquisar" class="form-control form-control-sm">

                            <div class="input-group-append">
                                <button onclick="pesquisarContatos()" class="btn btn-primary btn-sm" type="button"><span class="d-block d-sm-none d-md-none d-lg-none"><i class="fas fa-search"></i></span><span class="container-fluid d-none d-sm-block">buscar</span></button>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid d-none d-sm-block">
                <div id="contatos" class="row">
                </div>
            </div>
            <div class="container-fluid">
                <div id="contatosXS" class="d-block d-sm-none d-md-none d-lg-none">

                </div>
            </div>




        </div>

        <div style="position:fixed; right:20px; bottom:20px" class="d-block d-sm-none d-md-none d-lg-none">
            <a href="/criar-contato"> <button class="botaoCircular"> <i style="font-size:40px; color:white;" class="fas fa-user-plus"></i> </button> </a>
        </div>
        @section("scriptsPagina")

        <script>
          
            //Após a página estar pronta, todos os contatos são retornados
            $(document).ready(function() {

                recuperarContatos(""); //passando uma string vazia todos os contatos são retornados

            });


            function pesquisarContatos() {

                let nome = $('#nome').val();

                recuperarContatos(nome)

            }

            function recuperarContatos(nome) {

               //remove os contatos da tela antes de pesquisar
                $('#contatosXS').empty(); 
                $('#contatos').empty();

                $.ajax({
                    url: urlBackendAPI + 'contatos?nomePesquisa=' + nome
                    , method: 'GET'
                    , success: function(data) {

                        if (data.length == 0) {

                            $('#contatos').text("Nehum resultado");
                            $('#contatosXS').text("Nehum resultado");

                        }

                        for (let i = 0; i < data.length; i++) {

                            $("#contatos").append(`<div class="col-md-3"><a href="detalhes-contato?id=${data[i].id}"><div class="row align-items-center"><div class="col-md-4"><img class="img-fluid rounded-circle" src="/contato_avatar.png"></div><div class="col-md-8">${data[i].nome}</div></div></a></div>`);
                            $('#contatosXS').append(`<a href="/detalhes-contato?id=${data[i].id}"> <div class="row bg-light pb-2 align-items-content"><div class="col-md-2 col-2"><img class="img-fluid rounded-circle" src="/contato_avatar.png)"> </div> <div class="col-md-10 col-10 pt-2">${data[i].nome}</div>  </div></a>`);

                        }
                    }
                });
            }

        </script>
        @stop

        @stop
