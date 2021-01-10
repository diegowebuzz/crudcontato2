<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Cadastros de Contatos</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=noe">

  <meta name="description" content="The HTML5 Herald">
  <meta name="author" content="SitePoint">



     @include("styles")

</head>
        <div class="overflow-x:hidden; overflow-y:hidden;">

<body>
    
      @yield("corpo")


     

     @include("scripts") {{-- Essa seção é destinada aos scripts compatilhados pelas páginas em geral --}}

     @yield("scriptsPagina") {{-- Essa seção é destinada páginas que necessitam de scripts próprios --}}

</body>
 </div>

</html>