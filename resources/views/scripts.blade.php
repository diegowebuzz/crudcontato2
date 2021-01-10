<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" integrity="sha512-F5QTlBqZlvuBEs9LQPqc1iZv2UMxcVXezbHzomzS6Df4MZMClge/8+gXrKw2fl5ysdk4rWjR0vKS7NNkfymaBQ==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous"></script>

<script>

  var urlBackendAPI = 'http://192.168.0.104:8000/api/'; //as chamadas ajax utilizam essa variável
  var urlBackend = 'http://192.168.0.104:8000/';

 function autocompletarEndereco(){

let cep = $('#cep').val();



$.ajax({
     url:  "https://viacep.com.br/ws/" +  cep  + "/json/",
     method: 'GET',
     success: function(data){
        
        $('#logradouro').text(data.logradouro);
        $('#bairro').text(data.bairro);
        $('#localidade').text(data.localidade);

        $('#uf').text(data.uf);



     }
  });

}

</script>