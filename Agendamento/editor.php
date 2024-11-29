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

if (isset($_GET['agendamento_id'])) {
    $id = $_GET['agendamento_id'];

    // Recuperando os dados do agendamento
    $sql = "SELECT * FROM agendamentos WHERE agendamento_id = $id";
    $resultado = $conexao->query($sql);

    if ($resultado->num_rows > 0) {
        $agendamento = $resultado->fetch_assoc();
    } else {
        echo "Agendamento não encontrado!";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Atualizando os dados
    $nome = $_POST['agendamento_nome_cliente'];
    $servico = $_POST['agendamento_serviços'];
    $data = $_POST['agendamento_data'];
    $horario = $_POST['agendamento_horário'];
    $celular = $_POST['agendamento_celular'];

    $sql_update = "UPDATE agendamentos SET agendamento_nome_cliente = '$cliente', agendamento_serviços = '$servico', agendamento_data = '$data', agendamento_horário = '$horario', agendamento_celular = '$celular' 
    WHERE agendamento_id = $id";

    if ($conexao->query($sql_update) === TRUE) {
        echo "Agendamento atualizado com sucesso!";
        header("Location: admin.php"); // Redireciona para a página do administrador
        exit;
    } else {
        echo "Erro ao atualizar agendamento: " . $conexao->error;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar Agendamento</title>
</head>
<body>
  <h2>Editar Agendamento</h2>
  <form action="editar.php?id=<?php echo $agendamento['agendamento_id']; ?>" method="POST">
    <label for="nome">Nome do Cliente:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $agendamento['agendamento_nome_cliente']; ?>" required><br><br>

    <label for="servico">Serviço:</label>
    <select id="servico" name="servico" required>
      <option value="Corte de cabelo" <?php if ($agendamento['agendamento_serviços'] == 'Corte de cabelo') echo 'selected'; ?>>Corte de cabelo</option>
      <option value="Manicure" <?php if ($agendamento['agendamento_serviços'] == 'Manicure') echo 'selected'; ?>>Manicure</option>
      <option value="Massagem" <?php if ($agendamento['agendamento_serviços'] == 'Massagem') echo 'selected'; ?>>Massagem</option>
    </select><br><br>

    <label for="data">Data:</label>
    <input type="date" id="data" name="data" value="<?php echo $agendamento['agendamento_data']; ?>" required><br><br>

    <label for="horario">Horário:</label>
    <input type="time" id="horario" name="horario" value="<?php echo $agendamento['agendamento_horário']; ?>" required><br><br>

    <button type="submit">Atualizar Agendamento</button>
  </form>
</body>
</html>

<?php
// Fechando a conexão
$conexao->close();
?>
