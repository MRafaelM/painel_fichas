<?php
//Conexão com o BD seu cavalo...
require_once "../../config/pdo_database.php";
//Pega o último chamado aberto...
$consulta_produto = $pdo->prepare("SELECT numero, prioridade FROM chamados WHERE status = 'Aberto' ORDER BY id_chamado DESC LIMIT 1");
$consulta_produto->execute();
$chamado = $consulta_produto->fetch(PDO::FETCH_ASSOC);
$ultimo_numero = $chamado["numero"];
$prioridade = $chamado["prioridade"];
$repetir = $chamado["novamente"];
?>
<!DOCTYPE html>
<html>

<head>
  <title>Painel de Chamados</title>
  <link rel="icon" href="../assets/img/brasao.png">
  <link href="assets/css/painel.css" rel="stylesheet">
  <?php
  if ($prioridade == "Vermelho") {
    echo '
    <style>
        .senha-container {
            background-color: red;
        }

        .frase-container {
            background-color: red;
        }
        .sala-container {
          background-color: red;
        }
        .data-hora {
          color: red;
        }
      }
    </style>';
  } elseif ($prioridade == "Azul") {
    echo '
    <style>
        .senha-container {
            background-color: #007bff;
        }

        .frase-container {
            background-color: #007bff;
        }
        .sala-container {
          background-color: #007bff;
        }
        .data-hora {
          color: #007bff;
        }
    </style>';
  }
  ?>
</head>

<body>
  <audio id="audio" src="assets/audio/som1.mp3"></audio>
  <div class="container" id="container-div">
    <div class="senha-container">
      <?php if ($prioridade === "Vermelho") : ?>
        <h2 id="prioridade"><?php echo "PRIORITÁRIO Nº"; ?></h2>
      <?php else : ?>
        <h2 id="prioridade" style="display: none;"><?php echo $prioridade; ?></h2>
        <h2 id="texto">Senha número:</h2>
      <?php endif; ?>
      <h1 id="senha"><?php echo $ultimo_numero; ?></h1>
      <p id="repetir" type="hidden"><?php echo $repetir; ?></p>
    </div>
    <div class="sala-container">
      <h2>Prosseguir para:</h2>
      <h1 id="sala">Sala 1</h1>
    </div>
  </div>
  <div class="data-hora">
    <p id="data-hora"></p>
  </div>
  <div class="frase-container">
    <div class="frase">
      <h3>CIDADÃO, PEGOU SUA SENHA? AGUARDE SEU ATENDIMENTO, POR GENTILEZA FAÇA SILÊNCIO.</h3>
    </div>
  </div>
  <script>
    function atualizarDataHora() {
      var dataHora = new Date();
      var diaSemana = new Intl.DateTimeFormat('pt-BR', {
        weekday: 'long'
      }).format(dataHora);
      var dataFormatada = dataHora.toLocaleDateString();
      var horaFormatada = dataHora.toLocaleTimeString();
      document.getElementById("data-hora").innerHTML = diaSemana + " - " + dataFormatada + " - " + horaFormatada;
    }
    setInterval(atualizarDataHora, 1000);
  </script>
  <script>
    var ultimoNumero = <?php echo json_encode($ultimo_numero); ?>;
    var ultimoPrioridade = <?php echo json_encode($prioridade); ?>;
    var repetir = <?php echo json_encode($repetir); ?>;

    function atualizarDiv() {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var response = JSON.parse(this.responseText);
          if (response.numero != ultimoNumero || response.prioridade != ultimoPrioridade || response.repetir != repetir) {
            ultimoNumero = response.numero;
            ultimoPrioridade = response.prioridade;
            repetir = response.repetir;
            document.getElementById("container-div").innerHTML = response.html;
            document.getElementById("repetir").innerText = repetir;
            document.getElementById("repetir").style.display = "none";
            var audio = new Audio('assets/audio/som2.mp3');
            setTimeout(function() {
              audio.play();
            }, 2000); 
          }
        }
      };
      xhr.open("GET", "atualizar.php", true);
      xhr.send();
    }
    setInterval(atualizarDiv, 1000);
  </script>
</body>

</html>