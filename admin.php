<?php

require './code/conexao.php';

// Consultando os agendamentos
$sql = "SELECT age_id, age_servico, age_data, age_horario, age_nome_cliente, age_celular FROM agendamentos 
  ORDER BY age_data, age_horario";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="admin-styles.css">
  <title>Painel de Agendamentos</title>
</head>
<body>
  <div class="admin-container">
    <main>
  <section class="agendamentos" style="width: 68%">
    <h2>Lista de Agendamentos</h2>

    <table border="1">
      <thead>
        <tr>
          <th>Cliente</th>
          <th>Serviço</th>
          <th>Data</th>
          <th>Horário</th>
          <th>Celular</th>
          <th>Ações</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if ($resultado->rowCount() > 0) {
            // Exibindo os agendamentos
            foreach ($resultado as $linha) {
                echo "<tr>
                        <td>" . $linha['age_nome_cliente'] . "</td>
                        <td>" . $linha['age_servico'] . "</td>
                        <td>" . date("d/m/Y", strtotime($linha['age_data'])) . "</td>
                        <td>" . substr($linha['age_horario'], 0, 5)  . "</td>
                        <td>" . $linha['age_celular'] . "</td>
                        <td>
                          <a class='btn-edit' href='editar.php?id=" . $linha['age_id'] . "'>Editar</a>
                          <a class='btn-delete' href='desmarcar.php?id=" . $linha['age_id'] . "' onclick='return confirm(\"Tem certeza que deseja desmarcar?\")'>Desmarcar</a>
                          <a class='btn-delete' href='excluir.php?id=" . $linha['age_id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                        </td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum agendamento encontrado</td></tr>";
        }
        ?>
      </tbody>
    </table>
  </section>
  <section class="horarios" style="width: 30%">
        <h2>Editar Horários Disponíveis</h2>
        <form action="atualizar_horarios.php" method="POST">
          <label for="service">Serviço</label>
          <select id="service" name="servico" required>
            <option value="" disabled selected>Selecione o serviço</option>
            <option value="Corte de Cabelo">Corte de cabelo</option>
            <option value="Manicure">Manicure</option>
            <option value="Massagem">Massagem</option>
          </select>

          <label for="data">Data</label>
          <input type="date" id="data" name="data" required>

          <label for="available-times">Horários Disponíveis</label>
          <textarea id="available-times" name="horarios" rows="5" placeholder="Ex.: 09:00, 10:00, 14:30"></textarea>

          <button type="submit">Salvar Horários</button>
        </form>
      </section>
      </main>
</body>
</html>
