<?php

require './code/conexao.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'] ?? -1;

    // Recuperando os dados do agendamento
    $sql = "SELECT * FROM agendamentos WHERE age_id = $id";
    $resultado = $conn->query($sql);
    $agendamento = $resultado->fetch();

    if ($resultado->rowCount() > 0) {

    } else {
        echo "Agendamento não encontrado!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Atualizando os dados
    $nome = $_POST['nome'];
    $servico = $_POST['servico'];
    $data = $_POST['data'];
    $horario = $_POST['horario'];
    $celular = $_POST['celular'];

    $sql_update = "UPDATE agendamentos SET age_nome_cliente = '$nome', age_servico = '$servico', age_data = '$data', age_horario = '$horario', age_celular = '$celular' 
    WHERE age_id = $id";

    if ($conn->query($sql_update)) {
        echo "Agendamento atualizado com sucesso!";
        header("Location: admin.php"); // Redireciona para a página do administrador
        exit;
    } else {
        echo "Erro ao atualizar agendamento: " . $conn->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="editar-styles.css">
  <link rel="stylesheet" href="style.css">
  <title>Editar Agendamento</title>
</head>
<body>
  <div class="container">
    <h2>Editar Agendamento</h2>

    <form action="editar.php?id=<?php echo $agendamento['age_id']; ?>" class="schedule-form" method="POST">
      <input type="hidden" name="id" value="<?php echo $agendamento['age_id']; ?>">

      <label for="nome">Nome do Cliente:</label>
      <input type="text" id="nome" name="nome" value="<?php echo $agendamento['age_nome_cliente']; ?>" required>

      <label for="servico">Serviço:</label>
      <select id="servico" name="servico" required>
        <option value="Corte de cabelo" <?php if ($agendamento['age_servico'] == 'Corte de cabelo') echo 'selected'; ?>>Corte de cabelo</option>
        <option value="Manicure" <?php if ($agendamento['age_servico'] == 'Manicure') echo 'selected'; ?>>Manicure</option>
        <option value="Massagem" <?php if ($agendamento['age_servico'] == 'Massagem') echo 'selected'; ?>>Massagem</option>
      </select>

      <label for="data">Data:</label>
      <input type="date" id="data" name="data" value="<?php echo $agendamento['age_data']; ?>" required>

      <label for="horario">Horário:</label>
      <input type="time" id="horario" name="horario" value="<?php echo $agendamento['age_horario']; ?>" required>

      <label for="celular">Celular:</label>
      <input type="tel" id="celular" name="celular" value="<?php echo $agendamento['age_celular']; ?>" required>
      
      <button class="btn-success" type="submit">Atualizar Agendamento</button>
    </form>
  </div>
</body>
</html>
