<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Controle de Secretarias</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <div class="dashboard-container">
    <h2>Controle de Secretarias</h2>

    <div class="cards-container">
      
      <!-- Exemplo de Secretaria Ativa -->
      <div class="card ativa">
        <div class="header">
          <h3>Secretaria de Saúde</h3>
          <span class="status ativa">Ativa</span>
        </div>
        <div class="info">
          <p><strong>Responsável:</strong> João da Silva</p>
          <p><strong>Email:</strong> saude@soledade.rs.gov.br</p>
          <p><strong>Atendimentos Hoje:</strong> 132</p>
          <p><strong>Último acesso:</strong> 15/10/2025 17:48</p>
        </div>
        <div class="actions">
          <button class="btn editar">Editar</button>
          <button class="btn inativar">Inativar</button>
        </div>
      </div>

      <!-- Exemplo de Secretaria Inativa -->
      <div class="card inativa">
        <div class="header">
          <h3>Secretaria de Esportes</h3>
          <span class="status inativa">Inativa</span>
        </div>
        <div class="info">
          <p><strong>Responsável:</strong> Maria Oliveira</p>
          <p><strong>Email:</strong> esportes@soledade.rs.gov.br</p>
          <p><strong>Atendimentos Hoje:</strong> 0</p>
          <p><strong>Último acesso:</strong> 10/10/2025 14:33</p>
        </div>
        <div class="actions">
          <button class="btn editar">Editar</button>
          <button class="btn ativar">Ativar</button>
        </div>
      </div>

    </div>
  </div>

  <script src="assets/js/script.js"></script>
</body>
</html>
