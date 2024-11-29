<?php
$servidor = "localhost";
$usuario = "pc";
$senha = "1234";
$banco = "agendamento";

// Criando a conexão
$conexao = new mysqli($servidor, $usuario, $senha, $banco);

// Verificando a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Consultando os agendamentos
$sql = "SELECT agendamento_id, agendamento_serviços, agendamento_data, agendamento_horário, agendamento_nome_cliente, agendamento_celular FROM agendamentos 
  ORDER BY agendamento_data, agendamento_horário,";

$resultado = $conexao->query($sql);
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
  <h2>Lista de Agendamentos</h2>

  <table border="1">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Serviço</th>
        <th>Data</th>
        <th>Horário</th>
        <th>Ações</th>
        <th>Celular</th>
      </tr>
    </thead>
    <tbody>
      <?php
      if ($resultado->num_rows > 0) {
          // Exibindo os agendamentos
          while($linha = $resultado->fetch_assoc()) {
              echo "<tr>
                      <td>" . $linha['agendamento_id'] . "</td>
                      <td>" . $linha['agendamento_nome_cliente'] . "</td>
                      <td>" . $linha['agendamento_serviços'] . "</td>
                      <td>" . $linha['agendamento_data'] . "</td>
                      <td>" . $linha['agendamento_horário'] . "</td>
                      <td>" . $linha['agendamento_celular'] . "</td>
                       <td>
                        <a href='editar.php?id=" . $linha['agendamento_id'] . "'>Editar</a> | 
                        <a href='excluir.php?id=" . $linha['agendamento_id'] . "' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                      </td>
                    </tr>";
          }
      } else {
          echo "<tr><td colspan='6'>Nenhum agendamento encontrado</td></tr>";
      }
      ?>
    </tbody>
  </table>
</body>
</html>

<?php
// Fechando a conexão
$conexao->close();
?>
