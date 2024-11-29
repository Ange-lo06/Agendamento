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

    // Excluindo o agendamento
    $sql_delete = "DELETE FROM agendamentos WHERE agendamento_id = $id";

    if ($conexao->query($sql_delete) === TRUE) {
        echo "Agendamento excluído com sucesso!";
        header("Location: admin.php"); // Redireciona para a página do administrador
        exit;
    } else {
        echo "Erro ao excluir agendamento: " . $conexao->error;
    }
}

// Fechando a conexão
$conexao->close();
?>
