<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Agendamento de Serviços</h1>

        <?php
          if (isset($_GET["success"])) {
            if ($_GET["success"] == "1") {
              echo "<p style='color: green;'>Cadastro realizado com sucesso!</p>";
            } else {
              echo "<p style='color: red;'>Erro ao cadastrar!</p>";
            }
          }
        ?>
        
        <form class="schedule-form"  action="inserir.php" method="POST">
          <label for="servico">Serviço</label>
          <select id="servico" name="servico" required>
            <option value="" disabled selected>Selecione o serviço</option>
          </select>
    
          <label for="data">Data</label>
          <select id="data" name="data" required>
            <option value="" disabled selected>Selecione a data</option>
          </select>
    
          <label for="horario">Horário</label>
          <select id="horario" name="horario" required>
            <option value="" disabled selected>Selecione o horário</option>
          </select>

          <label for="nome">Nome do Cliente</label>
          <input type="text" id="nome" name="nome" placeholder="Seu nome" required>
    
          <label for="celular">Telefone</label>
          <input type="tel" id="celular" name="celular" placeholder="(XX) XXXXX-XXXX" required>
    
          <button type="submit">Agendar</button>
        </form>
      </div>    
</body>
<script src="script.js"></script>
</html>